<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Topup;
use App\Models\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    // ==================== TRANSFER ====================

    public function transfer(Request $request)
    {
        $data = $request->validate([
            'bank' => 'required|string|max:50',
            'receiver' => 'required|string|max:255',
            'account' => 'required|string|max:30',
            'amount' => 'required|numeric|min:10000',
            'description' => 'nullable|string|max:255',
        ]);

        $user = auth()->user();

        // Cek saldo
        if ($user->balance < $data['amount']) {
            return back()
                ->withInput()
                ->with('error', 'Saldo tidak mencukupi.');
        }

        DB::transaction(function () use ($user, $data) {

            // Kurangi saldo utama
            $user->decrement('balance', $data['amount']);

            // Simpan transaksi
            Transaction::create([
                'user_id' => $user->id,
                'type' => 'transfer',
                'amount' => $data['amount'],
                'description' =>
                    'Transfer ke ' .
                    $data['bank'] .
                    ' - ' .
                    $data['receiver'] .
                    ' (' .
                    $data['account'] .
                    ')' .
                    (
                        !empty($data['description'])
                        ? ' - ' . $data['description']
                        : ''
                    ),
                'status' => 'success',
            ]);
        });

        return back()->with(
            'success',
            'Transfer ke ' . $data['bank'] . ' berhasil.'
        );
    }


    // ==================== TOP UP ====================

    public function topup(Request $request)
    {
        $data = $request->validate([
            'amount' => 'required|numeric|min:10000',
            'method' => 'required|string',
        ]);

        // QRIS masuk ke halaman QRIS terlebih dahulu
        if (strtoupper($data['method']) === 'QRIS') {

            $transaction = Transaction::create([
                'user_id' => auth()->id(),
                'type' => 'topup',
                'amount' => $data['amount'],
                'description' => 'Top Up QRIS',
                'status' => 'pending',
            ]);

            return redirect()->route('qris', $transaction->id);
        }

        // Metode lain langsung berhasil
        $user = auth()->user();

        DB::transaction(function () use ($user, $data) {

            $user->increment('balance', $data['amount']);

            Topup::create([
                'user_id' => $user->id,
                'amount' => $data['amount'],
                'method' => $data['method'],
                'status' => 'success',
            ]);

            Transaction::create([
                'user_id' => $user->id,
                'type' => 'topup',
                'amount' => $data['amount'],
                'description' => 'Top Up ' . $data['method'],
                'status' => 'success',
            ]);
        });

        return back()->with('success', 'Top up berhasil.');
    }


    // ==================== QRIS ====================

    public function qris(Transaction $transaction)
    {
        if ($transaction->user_id !== auth()->id()) {
            abort(403);
        }

        return view('qris', compact('transaction'));
    }


    // ==================== KONFIRMASI QRIS ====================

    public function confirmQris(Transaction $transaction)
    {
        if ($transaction->user_id !== auth()->id()) {
            abort(403);
        }

        // Jangan proses transaksi yang sudah berhasil
        if ($transaction->status === 'success') {
            return redirect()
                ->route('history')
                ->with('success', 'Transaksi sudah berhasil.');
        }

        $user = auth()->user();


        // ==================== TOP UP QRIS ====================

        if ($transaction->type === 'topup') {

            DB::transaction(function () use ($user, $transaction) {

                $user->increment('balance', $transaction->amount);

                Topup::create([
                    'user_id' => $user->id,
                    'amount' => $transaction->amount,
                    'method' => 'QRIS',
                    'status' => 'success',
                ]);

                $transaction->update([
                    'status' => 'success',
                ]);
            });

            return redirect()
                ->route('history')
                ->with('success', 'Top Up QRIS berhasil!');
        }


        // ==================== BAYAR TAGIHAN ====================

        if ($transaction->type === 'payment') {

            if ($user->balance < $transaction->amount) {

                return redirect()
                    ->route('qris', $transaction->id)
                    ->with('error', 'Saldo tidak mencukupi.');
            }

            DB::transaction(function () use ($user, $transaction) {

                // Kurangi saldo
                $user->decrement('balance', $transaction->amount);

                // Tandai transaksi berhasil
                $transaction->update([
                    'status' => 'success',
                ]);

                // Cari tagihan pending terbaru dengan nominal yang sama
                $bill = Bill::where('user_id', $user->id)
                    ->where('amount', $transaction->amount)
                    ->where('status', 'pending')
                    ->latest()
                    ->first();

                if ($bill) {
                    $bill->update([
                        'status' => 'paid',
                    ]);
                }
            });

            return redirect()
                ->route('history')
                ->with('success', 'Pembayaran tagihan berhasil!');
        }


        return back()->with(
            'error',
            'Jenis transaksi tidak dikenali.'
        );
    }
}

