<!DOCTYPE html>

<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

```
<title>Dashboard - ArthaPay</title>

<style>
    * {
        box-sizing: border-box;
    }

    body {
        margin: 0;
        background: #eef2f7;
        font-family: Arial, sans-serif;
        color: #172033;
    }

    .app {
        max-width: 480px;
        min-height: 100vh;
        margin: auto;
        background: #f8fafc;
        padding-bottom: 90px;
    }

    .header {
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .header small {
        color: #8a95a5;
    }

    .header h3 {
        margin: 5px 0 0;
    }

    .avatar {
        width: 43px;
        height: 43px;
        border-radius: 14px;
        background: #dfe7f1;
        display: grid;
        place-items: center;
        font-weight: bold;
    }

    .content {
        padding: 0 18px;
    }

    .balance {
        background: #0f172a;
        color: white;
        padding: 22px;
        border-radius: 24px;
    }

    .balance small {
        color: #b8c1cf;
    }

    .balance h1 {
        font-size: 28px;
        margin: 12px 0;
    }

    .balance-number {
        color: #aab5c5;
        font-size: 12px;
        letter-spacing: 3px;
    }

    .quick {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 9px;
        margin: 17px 0;
    }

    .quick a {
        text-decoration: none;
        text-align: center;
        color: #172033;
        background: white;
        border-radius: 16px;
        padding: 13px 3px;
        font-size: 11px;
        font-weight: bold;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
    }

    .quick span {
        display: block;
        font-size: 22px;
        margin-bottom: 5px;
    }

    .section-title {
        margin: 23px 2px 10px;
        font-size: 16px;
    }

    .services {
        background: white;
        border-radius: 18px;
        overflow: hidden;
    }

    .service {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 15px;
        border-bottom: 1px solid #edf0f4;
        text-decoration: none;
        color: #172033;
    }

    .service:last-child {
        border: 0;
    }

    .service-icon {
        font-size: 22px;
    }

    .service div {
        flex: 1;
    }

    .service b {
        display: block;
        font-size: 13px;
    }

    .service small {
        color: #9aa4b3;
        font-size: 11px;
    }

    .transactions {
        background: white;
        border-radius: 18px;
        overflow: hidden;
    }

    .transaction {
        padding: 14px;
        display: flex;
        align-items: center;
        border-bottom: 1px solid #edf0f4;
    }

    .transaction:last-child {
        border-bottom: 0;
    }

    .transaction-icon {
        width: 38px;
        height: 38px;
        background: #edf1f6;
        border-radius: 12px;
        display: grid;
        place-items: center;
        margin-right: 11px;
    }

    .transaction-info {
        flex: 1;
    }

    .transaction-info b {
        display: block;
        font-size: 13px;
    }

    .transaction-info small {
        color: #9aa4b3;
        font-size: 10px;
    }

    .out {
        color: #dc5b63;
        font-size: 12px;
        font-weight: bold;
    }

    .in {
        color: #16835b;
        font-size: 12px;
        font-weight: bold;
    }

    .empty {
        padding: 20px;
        text-align: center;
        color: #8994a5;
        font-size: 13px;
    }

    .bottom {
        position: fixed;
        bottom: 0;
        width: min(480px, 100%);
        height: 70px;
        background: white;
        border-top: 1px solid #e5e9ef;
        display: grid;
        grid-template-columns: repeat(5, 1fr);
    }

    .bottom a {
        text-decoration: none;
        color: #8994a5;
        text-align: center;
        font-size: 10px;
        padding-top: 12px;
    }

    .bottom a span {
        display: block;
        font-size: 20px;
        margin-bottom: 3px;
    }

    .bottom .active {
        color: #0f172a;
        font-weight: bold;
    }
</style>
```

</head>

<body>

<div class="app">

```
<!-- HEADER -->

<header class="header">

    <div>
        <small>Selamat datang 👋</small>

        <h3>
            {{ auth()->user()->name }}
        </h3>
    </div>

    <div class="avatar">
        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
    </div>

</header>


<div class="content">

    <!-- SALDO -->

    <div class="balance">

        <small>
            Saldo ArthaPay
        </small>

        <h1>
            Rp {{ number_format(auth()->user()->balance, 0, ',', '.') }}
        </h1>

        <div class="balance-number">
            •••• •••• •••• 2450
        </div>

    </div>


    <!-- MENU CEPAT -->

    <div class="quick">

        <a href="{{ route('transfer.page') }}">
            <span>↗</span>
            Transfer
        </a>

        <a href="{{ route('topup.page') }}">
            <span>＋</span>
            Top Up
        </a>

        <a href="{{ route('bills') }}">
            <span>🧾</span>
            Tagihan
        </a>

        <a href="{{ route('savings') }}">
            <span>💰</span>
            Saku
        </a>

    </div>


    <!-- LAYANAN -->

    <h3 class="section-title">
        Layanan
    </h3>

    <div class="services">

        <a href="{{ route('savings') }}" class="service">

            <div class="service-icon">
                💰
            </div>

            <div>
                <b>Saku Uang</b>
                <small>Atur uang berdasarkan kebutuhan</small>
            </div>

            <span>›</span>

        </a>


        <div class="service">

            <div class="service-icon">
                📲
            </div>

            <div>
                <b>Pulsa & Data</b>
                <small>Isi ulang kapan saja</small>
            </div>

            <span>›</span>

        </div>


        <a href="{{ route('bills') }}" class="service">

            <div class="service-icon">
                💡
            </div>

            <div>
                <b>Listrik PLN</b>
                <small>Bayar tagihan listrik</small>
            </div>

            <span>›</span>

        </a>


        <a href="{{ route('bills') }}" class="service">

            <div class="service-icon">
                🌐
            </div>

            <div>
                <b>Internet</b>
                <small>Bayar WiFi bulanan</small>
            </div>

            <span>›</span>

        </a>

    </div>


    <!-- TRANSAKSI TERBARU -->

    <h3 class="section-title">
        Transaksi Terbaru
    </h3>

    <div class="transactions">

        @forelse($transactions as $transaction)

            <div class="transaction">

                <div class="transaction-icon">

                    @if($transaction->type === 'topup')

                        ＋

                    @elseif($transaction->type === 'transfer')

                        ↗

                    @elseif($transaction->type === 'payment')

                        🧾

                    @else

                        💳

                    @endif

                </div>


                <div class="transaction-info">

                    <b>
                        {{ ucfirst($transaction->type) }}
                    </b>

                    <small>
                        {{ $transaction->description }}
                    </small>

                    <br>

                    <small>
                        {{ $transaction->created_at->format('d M Y, H:i') }}
                    </small>

                </div>


                <div class="{{ $transaction->type === 'topup' ? 'in' : 'out' }}">

                    {{ $transaction->type === 'topup' ? '+' : '-' }}

                    Rp {{ number_format($transaction->amount, 0, ',', '.') }}

                </div>

            </div>

        @empty

            <div class="empty">
                Belum ada transaksi.
            </div>

        @endforelse

    </div>

</div>


<!-- NAVIGATION -->

<nav class="bottom">

    <a class="active" href="{{ route('dashboard') }}">
        <span>⌂</span>
        Beranda
    </a>

    <a href="{{ route('transfer.page') }}">
        <span>↗</span>
        Transfer
    </a>

    <a href="{{ route('topup.page') }}">
        <span>＋</span>
        Top Up
    </a>

    <a href="{{ route('history') }}">
        <span>↺</span>
        Riwayat
    </a>

    <a href="{{ route('profile') }}">
        <span>👤</span>
        Profil
    </a>

</nav>
```

</div>

</body>
</html>
