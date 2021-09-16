# guwudang.in-backend
HOW TO SETUP BACKEND
=========

1. Install project dependencies
```bash
composer install
```

2. Generate jwt key
```bash
php artisan jwt:secret
```

3. setup .env file from .env.example
```bash
DB_CONNECTION=mysql
```

4. seed database
```bash
php artisan migrate:fresh --seed
```

5. laravel artisan serve
```bash
php artisan serve
```
