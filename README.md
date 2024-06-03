# Docker Laravel Sample

## Demo

[Demo](https://stdeveloper.com/api/documentation) - demo api documentation


## Local usage

Run docker:
```console
dokcer-compose up -d
```

Set env:
```console
cp .env.example .env
```


Install dependencies:
```console
composer install
```

Migrate:
```console
php artisan migrate
```

Seed:
```console
php artisan db:seed
```

Test check:
```console
php artisan test --parallel --recreate-databases
```
