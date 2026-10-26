
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>QRIS - ArthaPay</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
        }

        .container {
            max-width: 450px;
            margin: 50px auto;
            padding: 20px;
        }

        .card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }

        h1 {
            margin-bottom: 5px;
        }

        .subtitle {
            color: #777;
            margin-bottom: 25px;
        }

        .amount {
            font-size: 30px;
            font-weight: bold;
            margin: 15px 0;
        }

        .qris {
            width: 230px;
            height: 230px;
            margin: 20px auto;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            border: 10px solid white;
            box-shadow: 0 0 0 1px #ddd;
        }

        .qris img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .info {
            text-align: left;
            background: #f7f7f7;
            padding: 15px;
            border-radius: 12px;
            margin: 20px 0;
        }

        .info p {
            margin: 8px 0;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .btn {
            width: 100%;
            border: none;
            padding: 14px;
            border-radius: 10px;
            background: #111827;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn:hover {
            opacity: .9;
        }

        .back {
            display: block;
            margin-top: 15px;
            color: #555;
            text-decoration: none;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="card">

        {{-- JUDUL OTOMATIS --}}
        @if($transaction->type === 'topup')
            <h1>Top Up QRIS</h1>

            <div class="subtitle">
                Scan QR untuk mengisi saldo ArthaPay
            </div>
        @else
            <h1>Bayar Tagihan</h1>

            <div class="subtitle">
                Scan QR untuk membayar tagihan
            </div>
        @endif


        {{-- PESAN ERROR --}}
        @if(session('error'))
            <div class="error">
                {{ session('error') }}
            </div>
        @endif


        {{-- NOMINAL --}}
        <div class="amount">
            Rp {{ number_format($transaction->amount, 0, ',', '.') }}
        </div>


        {{-- QRIS --}}
        <div class="qris">
            <img
                src="{{ asset('images/qris.png') }}"
                alt="QRIS ArthaPay"
            >
        </div>


        {{-- INFORMASI TRANSAKSI --}}
        <div class="info">

            <p>
                <strong>Transaksi:</strong>
                #{{ $transaction->id }}
            </p>

            <p>
                <strong>Keterangan:</strong>
                {{ $transaction->description }}
            </p>

            <p>
                <strong>Status:</strong>
                Menunggu pembayaran
            </p>

        </div>


        {{-- KONFIRMASI --}}
        <form
            action="{{ route('qris.confirm', $transaction->id) }}"
            method="POST"
        >
            @csrf

            <button type="submit" class="btn">
                Saya Sudah Bayar
            </button>
        </form>


        {{-- KEMBALI --}}
        @if($transaction->type === 'topup')

            <a href="{{ route('topup.page') }}" class="back">
                ← Kembali ke Top Up
            </a>

        @else

            <a href="{{ route('bills') }}" class="back">
                ← Kembali ke Tagihan
            </a>

        @endif

    </div>

</div>

</body>
</html>

