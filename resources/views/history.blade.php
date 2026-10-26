<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Riwayat - ArthaPay</title>

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

        .card {
            background: white;
            border-radius: 18px;
            padding: 10px 18px;
        }

        .transaction {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 0;
            border-bottom: 1px solid #eee;
        }

        .transaction:last-child {
            border-bottom: none;
        }

        .title {
            font-weight: bold;
        }

        .date {
            font-size: 12px;
            color: #888;
            margin-top: 5px;
        }

        .amount {
            font-weight: bold;
        }

        .income {
            color: #16a34a;
        }

        .expense {
            color: #dc2626;
        }

        .empty {
            text-align: center;
            padding: 30px 10px;
            color: #888;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">
        <h2>Riwayat</h2>

        <a href="{{ route('dashboard') }}">
            ← Kembali
        </a>
    </div>

    <div class="card">

        @forelse($transactions as $transaction)

            <div class="transaction">

                <div>
                    <div class="title">
                        {{ ucfirst($transaction->type) }}
                    </div>

                    <div>
                        {{ $transaction->description }}
                    </div>

                    <div class="date">
                        {{ $transaction->created_at->format('d M Y, H:i') }}
                    </div>
                </div>

                <div class="amount
                    {{ $transaction->type === 'topup' ? 'income' : 'expense' }}">

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

</body>
</html>