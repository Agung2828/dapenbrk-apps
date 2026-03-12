<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Dapen BRKS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .login-container {
            display: flex;
            min-height: 100vh;
        }

        /* LEFT SIDE - LOGIN FORM */
        .login-left {
            flex: 1;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            position: relative;
            z-index: 2;
        }

        .login-box {
            width: 100%;
            max-width: 400px;
        }

        .logo-section {
            margin-bottom: 40px;
        }


        .logo-section h2 {
            font-size: 14px;
            color: #64748b;
            font-weight: 500;
            margin: 0;
        }

        .welcome-text {
            margin-bottom: 40px;
        }

        .welcome-text h1 {
            font-size: 42px;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 8px;
        }

        .welcome-text .hello {
            color: #3b3f5c;
        }

        .welcome-text .welcome-word {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .welcome-text p {
            color: #64748b;
            font-size: 14px;
            margin-top: 8px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: #64748b;
            margin-bottom: 8px;
            display: block;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-control {
            height: 50px;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 15px;
            transition: all 0.3s;
            background: #f8fafc;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            background: #fff;
            outline: none;
        }

        .password-wrapper {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            padding: 4px;
            font-size: 18px;
        }

        .password-toggle:hover {
            color: #667eea;
        }

        .btn-login {
            width: 100%;
            height: 50px;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-transform: capitalize;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: #fff;
            box-shadow: 0 4px 15px rgba(42, 82, 152, 0.3);
            margin-top: 30px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(42, 82, 152, 0.4);
        }

        .btn-login i {
            margin-right: 8px;
        }

        .security-badge {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            color: #94a3b8;
            font-size: 12px;
            margin-top: 20px;
        }

        .security-badge i {
            color: #28a745;
        }

        /* RIGHT SIDE - FULL IMAGE */
        .login-right {
            flex: 1;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Illustration Container - Full Size */
        .illustration-container {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }

        .illustration-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        /* Attribution Overlay */
        .attribution {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, 0.5);
            padding: 12px 24px;
            border-radius: 25px;
            backdrop-filter: blur(10px);
            z-index: 10;
        }

        .attribution span {
            color: white;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        /* Error messages */
        .alert {
            border-radius: 10px;
            margin-bottom: 20px;
            border: none;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-danger {
            background: #fee;
            color: #c33;
        }

        .alert-danger::before {
            content: '\f06a';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .login-right {
                display: none;
            }

            .login-left {
                flex: 1;
                padding: 20px;
            }
        }

        @media (max-width: 576px) {
            .welcome-text h1 {
                font-size: 32px;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo-img img {
            width: 50px;
            /* ubah sesuai kebutuhan */
            height: auto;
        }

        .login-box {
            animation: fadeIn 0.6s ease;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <!-- LEFT SIDE -->
        <div class="login-left">
            <div class="login-box">
                <div class="logo-section">
                    <div class="logo-img">
                        <img src="{{ asset('image/LOGO1.png') }}" alt="Logo Dapen BRKS">
                    </div>
                    <h2>Dapen BRKS</h2>
                </div>

                <div class="welcome-text">
                    <h1>
                        <span class="welcome-word">Admin</span>
                    </h1>
                    <p>Sistem Manajemen Admin</p>
                </div>

                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <form method="POST" action="{{ route('login.process') }}">
                    @csrf

                    <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" placeholder="Masukkan email Anda"
                            required autofocus>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <div class="password-wrapper">
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Masukkan password Anda" required>
                            <button type="button" class="password-toggle" onclick="togglePassword()">
                                <i class="bi bi-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn-login">
                        <i class="fas fa-sign-in-alt"></i>
                        Masuk ke Dashboard
                    </button>

                    <div class="security-badge">
                        <i class="fas fa-shield-alt"></i>
                        <span>Koneksi aman dan terenkripsi</span>
                    </div>
                </form>
            </div>
        </div>

        <!-- RIGHT SIDE - FULL IMAGE -->
        <div class="login-right">
            <!-- Full Image Background -->
            <div class="illustration-container">
                <img src="{{ asset('image/DapenBRK.jpeg') }}" alt="Dapen BRKS">
            </div>

            <!-- Attribution Overlay -->
            <div class="attribution">
                <span>Dana Pensiun Bank Riau Kepri</span>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('bi-eye');
                toggleIcon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('bi-eye-slash');
                toggleIcon.classList.add('bi-eye');
            }
        }
    </script>
</body>

</html>
