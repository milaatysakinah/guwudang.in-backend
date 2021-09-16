# guwudang.in-backend
#HOW TO SETUP BACKEND

#install project dependencies
composer install

#generate jwt key
php artisan jwt:secret

#setup .env file from .env.example
DB_CONNECTION=mysql

#seed database
php artisan migrate:fresh --seed

#laravel artisan serve
php artisan serve
