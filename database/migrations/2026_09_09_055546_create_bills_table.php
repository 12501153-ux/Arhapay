<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillController extends Controller
{
    public function index()
    {
        $bills = Bill::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('bills', compact('bills'));
    }

    public function pay(Request $request, Bill $bill)
    {
        if ($bill->user_id !== auth()->id()) {
            abort(403);
        }

        if ($bill->status === 'paid') {
            return back()->with('error', 'Tagihan ini sudah dibayar.');
        }

        $user = auth()->user();

        if ($user->balance < $bill->amount) {
            return back()->with('error', 'Saldo tidak mencukupi.');
        }

        DB::transaction(function () use ($user, $bill) {
            $user->decrement('balance', $bill->amount);

            $bill->update([
                'status' => 'paid',
            ]);

            Transaction::create([
                'user_id' => $user->id,
                'type' => 'bill',
                'amount' => $bill->amount,
                'description' => 'Bayar ' . $bill->category,
                'status' => 'success',
            ]);
        });

        return back()->with('success', 'Tagihan berhasil dibayar.');
    }
}