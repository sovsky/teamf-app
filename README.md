# TEAMF

## Konfiguracja

W katalogu głównym z `compose.yaml` utworzyć plik konfiguracyjny `.env`:

```sh
APP_ENV=local
DB_CONNECTION=pgsql
DB_HOST=db
DB_PORT=5432
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

## Uruchomienie

### Uruchomienie tylko bazy danych

```sh
docker compose up db -d
```
