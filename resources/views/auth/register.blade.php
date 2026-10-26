
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - ArthaPay</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #eef2f7;
        }

        .container {
            max-width: 430px;
            min-height: 100vh;
            margin: auto;
            padding: 35px 22px;
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

        h1 {
            margin: 0;
            color: #0f172a;
        }

        .subtitle {
            color: #7c8799;
        }

        .card {
            background: white;
            padding: 23px;
            border-radius: 22px;
            margin-top: 20px;
        }

        label {
            display: block;
            margin: 14px 0 7px;
            font-weight: bold;
            font-size: 13px;
        }

        input {
            width: 100%;
            padding: 14px;
            border: 1px solid #dfe4eb;
            border-radius: 12px;
            outline: none;
        }

        input:focus {
            border-color: #0f172a;
        }

        button {
            width: 100%;
            padding: 15px;
            margin-top: 20px;
            border: 0;
            border-radius: 13px;
            background: #0f172a;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        .error {
            color: #dc2626;
            font-size: 12px;
        }

        a {
            color: #0f172a;
            font-weight: bold;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="logo">A</div>

    <h1>Buat akun</h1>
    <p class="subtitle">
        Daftar dan mulai gunakan ArthaPay.
    </p>

    <div class="card">

        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('register.process') }}">
            @csrf

            <label>Nama lengkap</label>
            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                placeholder="Nama kamu"
                required
            >

            <label>Email</label>
            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="nama@email.com"
                required
            >

            <label>Nomor HP</label>
            <input
                type="text"
                name="phone"
                value="{{ old('phone') }}"
                placeholder="08xxxxxxxxxx"
                required
            >

            <label>Password</label>
            <input
                type="password"
                name="password"
                placeholder="Minimal 6 karakter"
                required
            >

            <label>Konfirmasi password</label>
            <input
                type="password"
                name="password_confirmation"
                placeholder="Ulangi password"
                required
            >

            <button type="submit">
                Daftar Sekarang
            </button>
        </form>

        <p>
            Sudah punya akun?
            <a href="{{ route('login') }}">Masuk</a>
        </p>

    </div>

</div>

</body>
</html>