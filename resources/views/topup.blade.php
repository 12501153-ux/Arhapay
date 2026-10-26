
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Top Up - ArthaPay</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #eef2f7;
            font-family: Arial, sans-serif;
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
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 20px;
        }

        label {
            display: block;
            margin: 15px 0 7px;
            font-size: 13px;
            font-weight: bold;
        }

        input,
        select {
            width: 100%;
            padding: 14px;
            border: 1px solid #dfe4eb;
            border-radius: 12px;
        }

        .topup-button {
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

        .amounts {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .amounts button {
            border: 0;
            padding: 14px;
            border-radius: 12px;
            background: #eef2f7;
            color: #172033;
            font-weight: bold;
            cursor: pointer;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            padding: 12px;
            border-radius: 12px;
            margin: 15px 0;
        }

        .qris {
            margin-top: 20px;
            padding: 20px;
            background: #f8fafc;
            border-radius: 15px;
            text-align: center;
        }

        .qris img {
            display: block;
            width: 250px;
            max-width: 100%;
            margin: 15px auto 0;
            border-radius: 10px;
        }

        .qris p {
            font-size: 13px;
            color: #64748b;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

<div class="app">

    <a class="back" href="{{ route('dashboard') }}">‹</a>

    <h2>Top Up</h2>

    @if(session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">

        <form method="POST" action="{{ route('topup') }}">

            @csrf

            <label>Metode Top Up</label>

            <select name="method">
                <option value="Bank Transfer">Bank Transfer</option>
                <option value="QRIS">QRIS</option>
                <option value="Virtual Account">Virtual Account</option>
            </select>

            <label>Pilih nominal</label>

            <div class="amounts">

                <button type="button" onclick="setAmount(50000)">
                    Rp 50.000
                </button>

                <button type="button" onclick="setAmount(100000)">
                    Rp 100.000
                </button>

                <button type="button" onclick="setAmount(250000)">
                    Rp 250.000
                </button>

                <button type="button" onclick="setAmount(500000)">
                    Rp 500.000
                </button>

            </div>

            <label>Nominal lainnya</label>

            <input
                id="amount"
                type="number"
                name="amount"
                min="10000"
                placeholder="Minimal Rp 10.000"
                required
            >

            <button class="topup-button" type="submit">
                Top Up Sekarang
            </button>

        </form>

        @if(session('show_qris'))

            <div class="qris">

                <strong>Scan QRIS untuk pembayaran</strong>

                <p>
                    Scan QR Code di bawah menggunakan aplikasi pembayaran kamu.
                </p>

                <img
                    src="{{ asset('images/qris.png') }}"
                    alt="QRIS ArthaPay"
                >

            </div>

        @endif

    </div>

</div>

<script>
    function setAmount(amount) {
        document.getElementById('amount').value = amount;
    }
</script>

</body>
</html>

