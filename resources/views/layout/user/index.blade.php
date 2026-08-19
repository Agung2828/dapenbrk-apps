<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kepesertaan')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="{{ asset('js/app.js') }}" defer></script>

    <style>
        .backsound-toggle {
            position: fixed;
            bottom: 30px;
            left: 30px;
            z-index: 9999;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: rgba(0, 0, 0, 0.7);
            color: #fff;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 1.3rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
            transition: all 0.3s ease;
        }

        .backsound-toggle:hover {
            transform: scale(1.1);
            background: rgba(0, 0, 0, 0.85);
        }
    </style>
</head>

<body>

    <!-- BACKSOUND -->
    <audio id="backsound"></audio>

    <button id="toggleSound" class="backsound-toggle" aria-label="Toggle Backsound">
        <i class="fas fa-volume-mute"></i>
    </button>

    <div class="main-container">
        @yield('content')
    </div>

    <!-- BACKSOUND PLAYLIST -->
    <script>
        window.backsoundPlaylist = [
            "{{ asset('image/Jingle1.mp3') }}",
            "{{ asset('image/Jingle2.mp3') }}",
            "{{ asset('image/Jingle3.mp3') }}"
        ];
    </script>
    <script src="{{ asset('js/backsound.js') }}"></script>

</body>

</html>
