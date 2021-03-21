## Specifications

- PHP 7.2 or greater
- Laravel 7
- Bootstrap

## Developer Notes

Please follow these instructions to set up your development environment:

1. Rename .env.example to .env
2. composer update
3. sudo chmod -R 0777 storage
4. Set DB user name & password in .env ( DB_USERNAME & DB_PASSWORD )
5. php artisan make:database
6. php artisan key:generate
7. php artisan migrate
8. php artisan config:cache
9. php artisan serve
