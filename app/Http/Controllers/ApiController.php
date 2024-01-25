<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Balance;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    public function withdraw(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $amount = $request->input('amount');


        DB::transaction(function () use ($user, $amount) {
            $user->balance->decrement('amount', $amount);
            Transaction::create([
                'user_id' => $user->id,
                'amount' => -$amount,
            ]);
        });

        return response()->json(['message' => 'Amount withdrawn successfully']);
    }

    public function viewBalanceAndTransactions($userId)
    {
        $user = User::findOrFail($userId);
        $balance = $user->balance;
        $transactions = $user->transactions;

        return response()->json(['balance' => $balance, 'transactions' => $transactions]);
    }

    public function deposit(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $amount = $request->input('amount');


        DB::transaction(function () use ($user, $amount) {
            $user->balance->increment('amount', $amount);
            Transaction::create([
                'user_id' => $user->id,
                'amount' => $amount,
            ]);
        });

        return response()->json(['message' => 'Amount deposited successfully']);
    }
}
