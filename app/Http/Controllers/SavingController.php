<?php

namespace App\Http\Controllers;

use App\Models\Saving;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SavingController extends Controller
{
    public function index()
    {
        $savings = Saving::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('savings', compact('savings'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'icon' => 'nullable|string|max:10',
            'target' => 'nullable|numeric|min:0',
        ]);

        Saving::create([
            'user_id' => auth()->id(),
            'name' => $data['name'],
            'icon' => $data['icon'] ?? '💰',
            'balance' => 0,
            'target' => $data['target'] ?? null,
        ]);

        return back()->with('success', 'Saku berhasil dibuat!');
    }

    // MASUKKAN UANG KE SAKU
    public function deposit(Request $request, Saving $saving)
    {
        if ($saving->user_id !== auth()->id()) {
            abort(403);
        }

        $data = $request->validate([
            'amount' => 'required|numeric|min:1000',
        ]);

        $user = auth()->user();

        if ($user->balance < $data['amount']) {
            return back()->with('error', 'Saldo utama tidak mencukupi.');
        }

        DB::transaction(function () use ($user, $saving, $data) {

            $user->decrement('balance', $data['amount']);

            $saving->increment('balance', $data['amount']);
        });

        return back()->with(
            'success',
            'Uang berhasil dimasukkan ke saku!'
        );
    }

    // TARIK UANG DARI SAKU
    public function withdraw(Request $request, Saving $saving)
    {
        if ($saving->user_id !== auth()->id()) {
            abort(403);
        }

        $data = $request->validate([
            'amount' => 'required|numeric|min:1000',
        ]);

        if ($saving->balance < $data['amount']) {
            return back()->with(
                'error',
                'Saldo saku tidak mencukupi.'
            );
        }

        $user = auth()->user();

        DB::transaction(function () use ($user, $saving, $data) {

            $saving->decrement('balance', $data['amount']);

            $user->increment('balance', $data['amount']);
        });

        return back()->with(
            'success',
            'Uang berhasil ditarik dari saku!'
        );
    }
}