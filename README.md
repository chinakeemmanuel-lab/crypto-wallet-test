# Crypto Wallet Test

## Overview
This project implements a simple crypto wallet balance module.

Each user has a wallet per coin.  
The system supports deposit and withdrawal operations while ensuring data consistency.

## Features
- Wallet per user and coin
- Deposit logic
- Withdraw logic with balance validation
- Transaction history
- Database transactions to prevent race conditions
- Row locking to prevent double spending

## Architecture
- Laravel 12
- MySQL
- Service layer (WalletService)
- Migrations for wallets and transactions

## How to run
1. composer install
2. copy .env.example to .env
3. configure database
4. php artisan migrate
5. php artisan serve

## Notes
Withdraw operations use database transactions and row locking to ensure that concurrent requests cannot create negative balances.