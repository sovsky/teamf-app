# TEAMF

## Konfiguracja

W katalogu głównym z `compose.yaml` utworzyć plik konfiguracyjny `.env`:

```sh
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

## Uruchomienie

### Uruchomienie tylko bazy danych

```sh
docker compose up db -d
```
