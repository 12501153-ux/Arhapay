
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Bayar Tagihan - ArthaPay</title>

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
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
        }

        .back {
            text-decoration: none;
            color: #2563eb;
            font-size: 14px;
        }

        .message {
            padding: 12px 15px;
            border-radius: 12px;
            margin-bottom: 15px;
            font-size: 14px;
        }

        .success {
            background: #dcfce7;
            color: #166534;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
        }

        .card {
            background: white;
            border-radius: 18px;
            padding: 18px;
            margin-bottom: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .category {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .number {
            color: #777;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .amount {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .status {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 8px;
            font-size: 12px;
            margin-bottom: 15px;
        }

        .pending {
            background: #fef3c7;
            color: #92400e;
        }

        .paid {
            background: #dcfce7;
            color: #166534;
        }

        .failed {
            background: #fee2e2;
            color: #991b1b;
        }

        button {
            width: 100%;
            border: none;
            padding: 12px;
            border-radius: 10px;
            background: #2563eb;
            color: white;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background: #1d4ed8;
        }

        .already-paid {
            width: 100%;
            text-align: center;
            padding: 12px;
            border-radius: 10px;
            background: #f1f5f9;
            color: #64748b;
            font-size: 14px;
        }

        .empty {
            text-align: center;
            padding: 40px 10px;
            color: #888;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">
        <h2>Bayar Tagihan</h2>

        <a href="{{ route('dashboard') }}" class="back">
            ← Kembali
        </a>
    </div>


    @if(session('success'))
        <div class="message success">
            {{ session('success') }}
        </div>
    @endif


    @if(session('error'))
        <div class="message error">
            {{ session('error') }}
        </div>
    @endif


    @forelse($bills as $bill)

        <div class="card">

            <div class="category">
                {{ $bill->category }}
            </div>

            <div class="number">
                No. Pelanggan: {{ $bill->customer_number }}
            </div>

            <div class="amount">
                Rp {{ number_format($bill->amount, 0, ',', '.') }}
            </div>

            <div class="status {{ $bill->status }}">
                {{ ucfirst($bill->status) }}
            </div>


            @if($bill->status !== 'paid')

                <form action="{{ route('bills.pay', $bill->id) }}" method="POST">

                    @csrf

                    <button type="submit">
                        Bayar Sekarang
                    </button>

                </form>

            @else

                <div class="already-paid">
                    ✓ Tagihan sudah dibayar
                </div>

            @endif

        </div>

    @empty

        <div class="card empty">
            Belum ada tagihan.
        </div>

    @endforelse

</div>

</body>
</html>

