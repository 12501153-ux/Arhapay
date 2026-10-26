<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Transaction;

class BillController extends Controller
{
    // ==================== DAFTAR TAGIHAN ====================

    public function index()
    {
        $bills = Bill::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('bills', compact('bills'));
    }


    // ==================== BAYAR TAGIHAN ====================

    public function pay(Bill $bill)
    {
        // Pastikan tagihan milik user yang login
        if ($bill->user_id !== auth()->id()) {
            abort(403);
        }

        // Kalau sudah dibayar
        if ($bill->status === 'paid') {
            return back()->with(
                'error',
                'Tagihan ini sudah dibayar.'
            );
        }

        // Buat transaksi pending
        $transaction = Transaction::create([
            'user_id' => auth()->id(),
            'type' => 'payment',
            'amount' => $bill->amount,
            'description' => 'Bayar ' . $bill->category,
            'status' => 'pending',
        ]);

        // Masuk ke halaman QRIS
        return redirect()->route(
            'qris',
            $transaction->id
        );
    }
}