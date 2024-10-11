# Backend

## Pierwsze uruchomienie

W pliku `.env` zmienić zmienne dla bazy danych:

```sh
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

W wierszu poleceń:

```sh
composer update --prefer-dist laravel/laravel --ignore-platform-reqs
php artisan migrate:install
php artisan migrate:fresh
php artisan serve
```

## Problemy

### Windows

#### PostgreSQL - Could not find driver

W pliku `php.ini` w katalogu instalacyjnym PHP odkomentować `extension=pdo_pgsql`
`