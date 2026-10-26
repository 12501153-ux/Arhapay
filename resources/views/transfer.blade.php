
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Transfer - ArthaPay</title>

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
            padding: 20px;
        }

        .back {
            display: inline-block;
            text-decoration: none;
            color: #172033;
            font-size: 25px;
            margin-bottom: 15px;
        }

        h2 {
            margin-top: 0;
        }

        .balance {
            background: #0f172a;
            color: white;
            padding: 17px;
            border-radius: 16px;
            margin-bottom: 20px;
        }

        .balance h2 {
            margin: 8px 0 0;
        }

        .card {
            background: white;
            border-radius: 20px;
            padding: 20px;
        }

        .tabs {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            margin-bottom: 20px;
        }

        .tab {
            border: 1px solid #dfe4eb;
            background: #f8fafc;
            padding: 12px;
            border-radius: 12px;
            text-align: center;
            font-weight: bold;
            font-size: 13px;
        }

        .tab.active {
            background: #0f172a;
            color: white;
            border-color: #0f172a;
        }

        .wallets {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 8px;
            margin-bottom: 5px;
        }

        .wallet {
            border: 1px solid #dfe4eb;
            border-radius: 12px;
            padding: 12px 4px;
            text-align: center;
            cursor: pointer;
            background: white;
            font-size: 11px;
            font-weight: bold;
        }

        .wallet input {
            display: none;
        }

        .wallet:has(input:checked) {
            border: 2px solid #0f172a;
            background: #f1f5f9;
        }

        .wallet-icon {
            display: block;
            font-size: 22px;
            margin-bottom: 5px;
        }

        label {
            display: block;
            margin: 15px 0 7px;
            font-size: 13px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 14px;
            border: 1px solid #dfe4eb;
            border-radius: 12px;
            outline: none;
            background: white;
        }

        button {
            width: 100%;
            border: 0;
            background: #0f172a;
            color: white;
            padding: 15px;
            border-radius: 13px;
            margin-top: 22px;
            font-weight: bold;
            cursor: pointer;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            padding: 12px;
            border-radius: 12px;
            margin-bottom: 15px;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px;
            border-radius: 12px;
            margin-bottom: 15px;
        }

        .info {
            background: #f1f5f9;
            padding: 12px;
            border-radius: 12px;
            font-size: 11px;
            color: #64748b;
            margin-top: 15px;
        }
    </style>
</head>

<body>

<div class="app">

    <a class="back" href="{{ route('dashboard') }}">
        ‹
    </a>

    <h2>Transfer</h2>

    @if(session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="error">
            {{ session('error') }}
        </div>
    @endif


    <!-- SALDO -->

    <div class="balance">

        <small>Saldo tersedia</small>

        <h2>
            Rp {{ number_format(auth()->user()->balance, 0, ',', '.') }}
        </h2>

    </div>


    <div class="card">

        <!-- PILIH JENIS TRANSFER -->

        <div class="tabs">

            <div class="tab">
                🏦 Bank
            </div>

            <div class="tab active">
                📱 E-Wallet
            </div>

        </div>


        <form method="POST" action="{{ route('transfer') }}">

            @csrf

            <!-- E-WALLET -->

            <label>Pilih E-Wallet</label>

            <div class="wallets">

                <label class="wallet">

                    <input
                        type="radio"
                        name="bank"
                        value="DANA"
                        required
                    >

                    <span class="wallet-icon">💙</span>
                    DANA

                </label>


                <label class="wallet">

                    <input
                        type="radio"
                        name="bank"
                        value="GoPay"
                    >

                    <span class="wallet-icon">🟢</span>
                    GoPay

                </label>


                <label class="wallet">

                    <input
                        type="radio"
                        name="bank"
                        value="OVO"
                    >

                    <span class="wallet-icon">🟣</span>
                    OVO

                </label>


                <label class="wallet">

                    <input
                        type="radio"
                        name="bank"
                        value="ShopeePay"
                    >

                    <span class="wallet-icon">🟠</span>
                    ShopeePay

                </label>

            </div>


            <!-- NOMOR HP -->

            <label>Nomor HP E-Wallet</label>

            <input
                type="text"
                name="account"
                placeholder="08xxxxxxxxxx"
                inputmode="numeric"
                required
            >


            <!-- NAMA -->

            <label>Nama penerima</label>

            <input
                type="text"
                name="receiver"
                placeholder="Nama penerima"
                required
            >


            <!-- NOMINAL -->

            <label>Nominal transfer</label>

            <input
                type="number"
                name="amount"
                placeholder="10000"
                min="10000"
                required
            >


            <!-- CATATAN -->

            <label>Catatan</label>

            <input
                type="text"
                name="description"
                placeholder="Opsional"
            >


            <button type="submit">
                Transfer ke E-Wallet
            </button>


            <div class="info">
                💡 Transfer e-wallet ini merupakan simulasi untuk aplikasi ArthaPay.
            </div>

        </form>

    </div>

</div>

</body>
</html>
