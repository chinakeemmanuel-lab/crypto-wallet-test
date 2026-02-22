<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
use App\Services\WalletService;

Route::get('/deposit', function (WalletService $wallet) {
    $wallet->deposit(1, 'BTC', 0.5);
    return 'Deposit done';
});

Route::get('/withdraw', function (WalletService $wallet) {
    $wallet->withdraw(1, 'BTC', 0.2);
    return 'Withdraw done';
});