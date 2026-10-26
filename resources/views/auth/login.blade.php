<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ArthaPay</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #eef2f7;
        }
        .container {
            max-width: 430px;
            min-height: 100vh;
            margin: auto;
            padding: 40px 22px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .logo {
            width: 55px;
            height: 55px;
            background: #0f172a;
            color: white;
            border-radius: 17px;
            display: grid;
            place-items: center;
            font-size: 27px;
            font-weight: bold;
            margin-bottom: 15px;
        }
        h1 { margin: 0; color: #0f172a; }
        p { color: #7c8799; }
        .card {
            background: white;
            padding: 25px;
            border-radius: 22px;
            margin-top: 25px;
        }
        label {
            display: block;
            margin: 15px 0 7px;
            font-weight: bold;
            font-size: 14px;
        }
        input {
            width: 100%;
            padding: 14px;
            border: 1px solid #ddd;
            border-radius: 12px;
        }
        button {
            width: 100%;
            padding: 15px;
            margin-top: 22px;
            border: 0;
            border-radius: 13px;
            background: #0f172a;
            color: white;
            font-weight: bold;
        }
        a { color: #0f172a; font-weight: bold; }
    </style>
</head>
<body>

<div class="container">
    <div class="logo">A</div>

    <h1>ArthaPay</h1>
    <p>Simple. Secure. Smart.</p>

    <div class="card">
        <h2>Selamat datang 👋</h2>

        @if ($errors->any())
            <p style="color:red">{{ $errors->first() }}</p>
        @endif

        <form method="POST" action="{{ route('login.process') }}">
            @csrf

            <label>Email</label>
            <input type="email" name="email" placeholder="nama@email.com">

            <label>Password</label>
            <input type="password" name="password" placeholder="••••••••">

            <button type="submit">Masuk</button>
        </form>

        <p>
            Belum punya akun?
            <a href="{{ route('register') }}">Daftar</a>
        </p>
    </div>
</div>

</body>
</html>