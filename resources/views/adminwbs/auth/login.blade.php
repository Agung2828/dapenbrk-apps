<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login Admin WBS - Dapen BRKS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #0f2447;
            font-family: 'Segoe UI', Tahoma, sans-serif;
        }

        .box {
            background: #fff;
            border-radius: 18px;
            padding: 40px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, .3);
        }

        .box h1 {
            font-size: 24px;
            font-weight: 800;
            color: #1e3c72;
        }

        .box p.sub {
            color: #6b7280;
            font-size: 13.5px;
            margin-bottom: 24px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #dc3545, #f59e0b);
            border: none;
            font-weight: 700;
        }
    </style>
</head>

<body>
    <div class="box">
        <div
            style="width:56px;height:56px;border-radius:16px;background:linear-gradient(135deg,#1e3c72,#2a5298);display:flex;align-items:center;justify-content:center;margin-bottom:16px;">
            <i class="fas fa-shield-halved" style="color:#fbbf24;font-size:24px;"></i>
        </div>
        <h1>Admin WBS</h1>
        <p class="sub">Dana Pensiun Bank Riau Kepri</p>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('adminwbs.login.process') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required
                    autofocus>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100 mt-2"><i class="fas fa-sign-in-alt"></i> Masuk</button>
        </form>
    </div>
</body>

</html>
