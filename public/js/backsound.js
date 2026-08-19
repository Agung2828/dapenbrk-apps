document.addEventListener('DOMContentLoaded', () => {
    const audio = document.getElementById('backsound');
    const toggleBtn = document.getElementById('toggleSound');
    if (!audio || !toggleBtn) return;

    // Playlist diambil dari variable global yang didefinisikan di tiap halaman blade
    const playlist = window.backsoundPlaylist || [];
    if (playlist.length === 0) return;

    let currentIndex = sessionStorage.getItem('backsound_index');
    if (currentIndex === null || parseInt(currentIndex) >= playlist.length) {
        currentIndex = Math.floor(Math.random() * playlist.length);
    } else {
        currentIndex = parseInt(currentIndex);
    }

    let isPlaying = sessionStorage.getItem('backsound_playing') !== 'false';
    const savedTime = parseFloat(sessionStorage.getItem('backsound_time')) || 0;

    audio.src = playlist[currentIndex];
    audio.volume = 0.5;
    audio.currentTime = savedTime;

    // FIX: ikon sekarang mempertimbangkan audio.muted juga, bukan hanya isPlaying.
    // Kalau audio sedang "playing" tapi muted (misalnya karena diblokir autoplay
    // policy browser), ikon akan tetap menampilkan volume-mute, bukan volume-up
    // yang menyesatkan.
    function updateIcon() {
        const showAsUnmuted = isPlaying && !audio.muted;
        toggleBtn.innerHTML = showAsUnmuted
            ? '<i class="fas fa-volume-up"></i>'
            : '<i class="fas fa-volume-mute"></i>';
    }

    function saveState() {
        sessionStorage.setItem('backsound_index', currentIndex);
        sessionStorage.setItem('backsound_time', audio.currentTime);
        sessionStorage.setItem('backsound_playing', isPlaying);
    }

    function playNextRandom() {
        let nextIndex;
        if (playlist.length > 1) {
            do {
                nextIndex = Math.floor(Math.random() * playlist.length);
            } while (nextIndex === currentIndex);
        } else {
            nextIndex = 0;
        }
        currentIndex = nextIndex;
        audio.src = playlist[currentIndex];
        audio.currentTime = 0;
        audio.play().catch(() => { });
        saveState();
    }

    // Sekali user melakukan interaksi APAPUN (klik, tap, scroll, keydown),
    // audio langsung di-unmute (kalau saat itu masih muted karena autoplay policy).
    function bindUnmuteOnInteraction() {
        const unmute = () => {
            if (audio.muted) {
                audio.muted = false;
            }
            if (isPlaying && audio.paused) {
                audio.play().catch(() => { });
            }
            // FIX: update ikon setelah status muted berubah lewat interaksi umum,
            // supaya ikon langsung sinkron (bukan menunggu klik tombol lagi).
            updateIcon();
            saveState();
        };
        ['pointerdown', 'keydown', 'touchstart', 'scroll'].forEach(evt => {
            document.addEventListener(evt, unmute, { once: true, passive: true });
        });
    }

    function tryPlay() {
        // Percobaan 1: langsung play dengan suara (browser bisa izinkan
        // kalau user sudah pernah berinteraksi dengan audio di origin ini sebelumnya)
        audio.muted = false;
        audio.play().then(() => {
            isPlaying = true;
            updateIcon();
        }).catch(() => {
            // Percobaan 2: browser blokir autoplay bersuara -> putar dalam mode muted
            // (ini SELALU diizinkan browser), lalu auto-unmute di interaksi pertama.
            audio.muted = true;
            audio.play().then(() => {
                isPlaying = true;
                // FIX: ikon tetap menampilkan "muted" di sini (bukan volume-up)
                // karena audio.muted masih true - updateIcon() sekarang menangani ini sendiri.
                updateIcon();
                bindUnmuteOnInteraction();
            }).catch(() => {
                // Kalaupun muted-play gagal (jarang terjadi), fallback terakhir:
                // tunggu interaksi pertama baru play seperti biasa.
                isPlaying = false;
                updateIcon();
            });
        });
    }

    if (isPlaying) {
        tryPlay();
    } else {
        updateIcon();
    }

    // Fallback umum: kalau semua percobaan di atas tetap gagal total,
    // interaksi pertama di body akan memaksa play.
    document.body.addEventListener('click', function firstInteraction() {
        if (isPlaying && audio.paused) {
            audio.muted = false;
            audio.play().catch(() => { });
            updateIcon();
        }
        document.body.removeEventListener('click', firstInteraction);
    }, { once: true });

    // FIX UTAMA: sebelumnya toggle hanya mengecek isPlaying, sehingga ketika
    // audio sedang "playing" tapi muted (kasus autoplay diblokir), klik pertama
    // pada tombol malah men-DIAM-kan lagu sepenuhnya (audio.pause()) alih-alih
    // meng-unmute-nya. Sekarang toggle mengecek kombinasi isPlaying DAN audio.muted:
    // - Kalau sedang benar-benar terdengar (playing & tidak muted) -> pause (mute penuh).
    // - Kalau sedang diam (paused ATAU playing-tapi-muted) -> unmute & play.
    toggleBtn.addEventListener('click', (e) => {
        e.stopPropagation();

        const currentlyAudible = isPlaying && !audio.muted && !audio.paused;

        if (currentlyAudible) {
            audio.pause();
            isPlaying = false;
        } else {
            audio.muted = false;
            isPlaying = true;
            audio.play().catch(() => { });
        }

        updateIcon();
        saveState();
    });

    audio.addEventListener('ended', () => {
        playNextRandom();
    });

    setInterval(saveState, 1000);
    window.addEventListener('beforeunload', saveState);
});