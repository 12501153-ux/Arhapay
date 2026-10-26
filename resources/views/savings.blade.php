<!DOCTYPE html>

<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

```
<title>Saku Uang - ArthaPay</title>

<style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
    }

    body {
        background: #f5f7fa;
        color: #222;
    }

    .container {
        max-width: 900px;
        margin: auto;
        padding: 30px 20px;
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .header h1 {
        font-size: 28px;
    }

    .back {
        text-decoration: none;
        color: #555;
    }

    .total-card {
        background: linear-gradient(135deg, #1677ff, #4d9aff);
        color: white;
        padding: 25px;
        border-radius: 20px;
        margin-bottom: 25px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
    }

    .total-card p {
        opacity: 0.9;
        margin-bottom: 8px;
    }

    .total-card h2 {
        font-size: 30px;
    }

    .create-box {
        background: white;
        padding: 25px;
        border-radius: 18px;
        margin-bottom: 25px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    .create-box h2 {
        margin-bottom: 18px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        margin-bottom: 7px;
        font-weight: bold;
    }

    input {
        width: 100%;
        padding: 12px;
        border: 1px solid #ddd;
        border-radius: 10px;
        font-size: 15px;
    }

    button {
        border: none;
        cursor: pointer;
    }

    .create-btn {
        background: #1677ff;
        color: white;
        padding: 12px 20px;
        border-radius: 10px;
        font-weight: bold;
    }

    .create-btn:hover {
        opacity: 0.9;
    }

    .message {
        padding: 12px 15px;
        border-radius: 10px;
        margin-bottom: 20px;
        background: #e8f7ee;
        color: #16803c;
    }

    .error-message {
        padding: 12px 15px;
        border-radius: 10px;
        margin-bottom: 20px;
        background: #fdecec;
        color: #c62828;
    }

    .savings-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 18px;
    }

    .saving-card {
        background: white;
        padding: 22px;
        border-radius: 18px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    .saving-top {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 20px;
    }

    .icon {
        width: 50px;
        height: 50px;
        border-radius: 14px;
        background: #eef5ff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 25px;
    }

    .saving-name {
        font-size: 18px;
        font-weight: bold;
    }

    .saving-balance {
        font-size: 23px;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .target {
        font-size: 13px;
        color: #777;
        margin-bottom: 8px;
    }

    .progress-bg {
        width: 100%;
        height: 9px;
        background: #eee;
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 18px;
    }

    .progress {
        height: 100%;
        background: #1677ff;
        border-radius: 10px;
    }

    .saving-actions {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        margin-top: 18px;
    }

    .action-box {
        display: flex;
        flex-direction: column;
    }

    .action-box input {
        margin-bottom: 8px;
        padding: 10px;
    }

    .deposit-btn {
        width: 100%;
        padding: 10px;
        border-radius: 10px;
        background: #1677ff;
        color: white;
        font-weight: bold;
    }

    .withdraw-btn {
        width: 100%;
        padding: 10px;
        border-radius: 10px;
        background: #555;
        color: white;
        font-weight: bold;
    }

    .deposit-btn:hover,
    .withdraw-btn:hover {
        opacity: 0.9;
    }

    .empty {
        background: white;
        padding: 35px;
        text-align: center;
        border-radius: 18px;
        color: #777;
    }

    @media (max-width: 600px) {

        .header h1 {
            font-size: 23px;
        }

        .total-card h2 {
            font-size: 25px;
        }

        .saving-actions {
            grid-template-columns: 1fr;
        }
    }
</style>
```

</head>

<body>

<div class="container">

```
<!-- HEADER -->

<div class="header">

    <h1>💰 Saku Uang</h1>

    <a href="{{ route('dashboard') }}" class="back">
        ← Dashboard
    </a>

</div>


<!-- PESAN SUKSES -->

@if(session('success'))

    <div class="message">
        {{ session('success') }}
    </div>

@endif


<!-- PESAN ERROR -->

@if(session('error'))

    <div class="error-message">
        {{ session('error') }}
    </div>

@endif


<!-- TOTAL UANG DI SAKU -->

<div class="total-card">

    <p>Total Uang di Saku</p>

    <h2>
        Rp {{ number_format((float) $savings->sum('balance'), 0, ',', '.') }}
    </h2>

</div>


<!-- BUAT SAKU BARU -->

<div class="create-box">

    <h2>+ Buat Saku Baru</h2>

    <form action="{{ route('savings.store') }}" method="POST">

        @csrf

        <div class="form-group">

            <label>Nama Saku</label>

            <input
                type="text"
                name="name"
                placeholder="Contoh: Makan, Transportasi, Laptop"
                required
            >

        </div>


        <div class="form-group">

            <label>Icon</label>

            <input
                type="text"
                name="icon"
                placeholder="💰"
                maxlength="10"
            >

        </div>


        <div class="form-group">

            <label>Target (opsional)</label>

            <input
                type="number"
                name="target"
                placeholder="Contoh: 5000000"
                min="0"
            >

        </div>


        <button type="submit" class="create-btn">
            Buat Saku
        </button>

    </form>

</div>


<!-- DAFTAR SAKU -->

<h2 style="margin-bottom: 15px;">
    Saku Saya
</h2>


@if($savings->count() > 0)

    <div class="savings-grid">

        @foreach($savings as $saving)

            @php

                $progress = 0;

                if ($saving->target && $saving->target > 0) {

                    $progress = min(
                        100,
                        ((float) $saving->balance / (float) $saving->target) * 100
                    );

                }

            @endphp


            <div class="saving-card">

                <!-- NAMA SAKU -->

                <div class="saving-top">

                    <div class="icon">
                        {{ $saving->icon }}
                    </div>

                    <div class="saving-name">
                        {{ $saving->name }}
                    </div>

                </div>


                <!-- SALDO SAKU -->

                <div class="saving-balance">

                    Rp {{ number_format((float) $saving->balance, 0, ',', '.') }}

                </div>


                <!-- TARGET -->

                @if($saving->target)

                    <div class="target">

                        Target:
                        Rp {{ number_format((float) $saving->target, 0, ',', '.') }}

                        <br>

                        {{ number_format($progress, 0) }}%

                    </div>


                    <div class="progress-bg">

                        <div
                            class="progress"
                            style="width: {{ $progress }}%;"
                        ></div>

                    </div>

                @else

                    <div class="target">
                        Belum ada target
                    </div>

                @endif


                <!-- AKSI SAKU -->

                <div class="saving-actions">

                    <!-- MASUKKAN UANG -->

                    <form
                        action="{{ route('savings.deposit', $saving->id) }}"
                        method="POST"
                        class="action-box"
                    >

                        @csrf

                        <input
                            type="number"
                            name="amount"
                            placeholder="Jumlah"
                            min="1000"
                            required
                        >

                        <button
                            type="submit"
                            class="deposit-btn"
                        >
                            + Masukkan
                        </button>

                    </form>


                    <!-- TARIK UANG -->

                    <form
                        action="{{ route('savings.withdraw', $saving->id) }}"
                        method="POST"
                        class="action-box"
                    >

                        @csrf

                        <input
                            type="number"
                            name="amount"
                            placeholder="Jumlah"
                            min="1000"
                            required
                        >

                        <button
                            type="submit"
                            class="withdraw-btn"
                        >
                            − Tarik
                        </button>

                    </form>

                </div>

            </div>

        @endforeach

    </div>

@else

    <div class="empty">

        <h3>Belum ada saku</h3>

        <p style="margin-top: 8px;">
            Buat saku pertama lo untuk mulai mengatur uang.
        </p>

    </div>

@endif
```

</div>

</body>
</html>
