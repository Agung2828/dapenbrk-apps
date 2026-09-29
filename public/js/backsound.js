/* ============================================================
   BACKSOUND - satu pemutar untuk semua halaman
   - Aman walau script ter-load 2x atau tombol/audio dobel di HTML
   - Lagu lanjut di halaman lain (lagu, posisi detik, status main/mati)
   ============================================================ */
(function () {
    if (window.__backsoundInit) return;
    window.__backsoundInit = true;

    const KEY = 'dapen_backsound_state';
    const playlist = Array.isArray(window.backsoundPlaylist) ? window.backsoundPlaylist : [];
    if (!playlist.length) return;

    /* ---------- State tersimpan ---------- */
    const load = () => {
        try { return JSON.parse(sessionStorage.getItem(KEY)) || {}; } catch (e) { return {}; }
    };
    const save = (patch) => {
        try {
            const s = Object.assign(load(), patch);
            sessionStorage.setItem(KEY, JSON.stringify(s));
        } catch (e) { }
    };

    function init() {
        /* ---------- Hapus duplikat ---------- */
        const audios = Array.from(document.querySelectorAll('audio#backsound'));
        let audio = audios[0];
        audios.slice(1).forEach(a => { a.pause(); a.remove(); });
        if (!audio) {
            audio = document.createElement('audio');
            audio.id = 'backsound';
            document.body.appendChild(audio);
        }

        const btns = Array.from(document.querySelectorAll('#toggleSound, .backsound-toggle'));
        let btn = btns[0];
        btns.slice(1).forEach(b => b.remove());
        if (!btn) {
            btn = document.createElement('button');
            btn.id = 'toggleSound';
            btn.className = 'backsound-toggle';
            btn.setAttribute('aria-label', 'Toggle Backsound');
            btn.innerHTML = '<i class="fas fa-volume-mute"></i>';
            btn.style.cssText = 'position:fixed;bottom:30px;left:30px;z-index:9999;width:50px;height:50px;' +
                'border-radius:50%;background:rgba(0,0,0,.7);color:#fff;border:none;display:flex;' +
                'align-items:center;justify-content:center;cursor:pointer;font-size:1.3rem;';
            document.body.appendChild(btn);
        }

        // Buang listener lama (kalau ada) dengan mengganti node tombol
        const fresh = btn.cloneNode(true);
        btn.replaceWith(fresh);
        btn = fresh;

        const icon = () => btn.querySelector('i');
        const setIcon = (on) => {
            const i = icon();
            if (i) i.className = 'fas ' + (on ? 'fa-volume-up' : 'fa-volume-mute');
        };

        /* ---------- Pemutar ---------- */
        const st = load();
        let index = Number.isInteger(st.index) && st.index < playlist.length ? st.index : 0;
        audio.loop = false;
        audio.preload = 'auto';
        audio.src = playlist[index];

        const wantPlay = st.playing === true;
        const resumeAt = typeof st.time === 'number' ? st.time : 0;

        audio.addEventListener('loadedmetadata', function once() {
            if (resumeAt > 0 && resumeAt < (audio.duration || Infinity)) {
                try { audio.currentTime = resumeAt; } catch (e) { }
            }
            audio.removeEventListener('loadedmetadata', once);
        });

        audio.addEventListener('ended', () => {
            index = (index + 1) % playlist.length;
            audio.src = playlist[index];
            save({ index, time: 0 });
            audio.play().catch(() => { });
        });

        audio.addEventListener('play', () => { setIcon(true); save({ playing: true, index }); });
        audio.addEventListener('pause', () => {
            if (!audio.ended) setIcon(false);
        });

        /* Simpan posisi lagu secara berkala dan sebelum pindah halaman */
        let last = 0;
        audio.addEventListener('timeupdate', () => {
            const now = Date.now();
            if (now - last > 1000) { last = now; save({ time: audio.currentTime, index }); }
        });
        const persist = () => save({ time: audio.currentTime, index });
        window.addEventListener('pagehide', persist);
        window.addEventListener('beforeunload', persist);

        /* ---------- Tombol ---------- */
        btn.addEventListener('click', () => {
            if (audio.paused) {
                audio.play().then(() => save({ playing: true })).catch(() => { });
            } else {
                audio.pause();
                save({ playing: false, time: audio.currentTime });
            }
        });

        /* ---------- Lanjutkan otomatis di halaman baru ---------- */
        if (wantPlay) {
            setIcon(true);
            audio.play().catch(() => {
                // Browser memblokir autoplay: lanjut di interaksi pertama (klik/tap/tombol/scroll)
                setIcon(false);
                const resume = (e) => {
                    if (btn.contains(e.target)) return cleanup(); // biar tombol yang menangani
                    audio.play().catch(() => { });
                    cleanup();
                };
                const evts = ['pointerdown', 'keydown', 'touchstart', 'wheel'];
                const cleanup = () => evts.forEach(ev => window.removeEventListener(ev, resume, true));
                evts.forEach(ev => window.addEventListener(ev, resume, { capture: true, passive: true }));
            });
        } else {
            setIcon(false);
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();