Crypto Wallet Test

Features:
- Wallet per user and coin
- Deposit and withdraw logic
- Transaction history
- DB transactions to prevent race conditions
- Balance validation to prevent negative balance

Tech:
- Laravel 12
- MySQL
- Service layer (WalletService)

How to run:
- composer install
- configure .env
- php artisan migrate
- php artisan serve