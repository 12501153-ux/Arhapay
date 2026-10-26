<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Profil - ArthaPay</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f5f7fb;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 480px;
            margin: auto;
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .profile-card {
            background: white;
            border-radius: 20px;
            padding: 25px;
            text-align: center;
            margin-top: 20px;
        }

        .avatar {
            width: 80px;
            height: 80px;
            margin: auto;
            border-radius: 50%;
            background: #111827;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            font-weight: bold;
        }

        .name {
            font-size: 22px;
            font-weight: bold;
            margin-top: 15px;
        }

        .email {
            color: #777;
            margin-top: 5px;
        }

        .menu {
            background: white;
            border-radius: 18px;
            margin-top: 20px;
            overflow: hidden;
        }

        .menu-item {
            padding: 18px;
            border-bottom: 1px solid #eee;
        }

        .menu-item:last-child {
            border-bottom: none;
        }

        .logout {
            margin-top: 20px;
        }

        .logout button {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 12px;
            background: #dc2626;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">
        <h2>Profil</h2>

        <a href="{{ route('dashboard') }}">
            ← Dashboard
        </a>
    </div>

    <div class="profile-card">

        <div class="avatar">
            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </div>

        <div class="name">
            {{ auth()->user()->name }}
        </div>

        <div class="email">
            {{ auth()->user()->email }}
        </div>

    </div>

    <div class="menu">

        <div class="menu-item">
            <strong>Nama</strong><br>
            {{ auth()->user()->name }}
        </div>

        <div class="menu-item">
            <strong>Email</strong><br>
            {{ auth()->user()->email }}
        </div>

        <div class="menu-item">
            <strong>No. HP</strong><br>
            {{ auth()->user()->phone }}
        </div>

        <div class="menu-item">
            <strong>Saldo</strong><br>
            Rp {{ number_format(auth()->user()->balance, 0, ',', '.') }}
        </div>

    </div>

    <div class="logout">

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit">
                Keluar
            </button>

        </form>

    </div>

</div>

</body>
</html>