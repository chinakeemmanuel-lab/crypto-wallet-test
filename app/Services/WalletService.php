<?php

namespace App\Services;

use App\Models\Wallet;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Exception;

class WalletService
{
    public function deposit($userId, $coin, $amount)
    {
        DB::transaction(function () use ($userId, $coin, $amount) {

            $wallet = Wallet::firstOrCreate([
                'user_id' => $userId,
                'coin' => $coin
            ]);

            $wallet->balance += $amount;
            $wallet->save();

            Transaction::create([
                'wallet_id' => $wallet->id,
                'type' => 'deposit',
                'amount' => $amount,
                'status' => 'confirmed'
            ]);
        });
    }

    public function withdraw($userId, $coin, $amount)
    {
        DB::transaction(function () use ($userId, $coin, $amount) {

            $wallet = Wallet::where('user_id', $userId)
                ->where('coin', $coin)
                ->lockForUpdate()
                ->first();

            if (!$wallet || $wallet->balance < $amount) {
                throw new Exception('Insufficient balance');
            }

            $wallet->balance -= $amount;
            $wallet->save();

            Transaction::create([
                'wallet_id' => $wallet->id,
                'type' => 'withdraw',
                'amount' => $amount,
                'status' => 'confirmed'
            ]);
        });
    }
}
?>