
# Fika

<p align="center">
    <img src="https://github.com/ATholin/fika/workflows/Fika%20CI/badge.svg" alt="Build Status">
    <img src="https://img.shields.io/badge/License-MIT-yellow.svg" alt="Build Status">
</p>

Small service for fika timer and countdown. Create and manage break times with a custom url.

## Getting started

### Launch the starter project

*(Assuming you've [installed Laravel](https://laravel.com/docs/installation))*


``` bash
git clone https://www.github.com/ATholin/fika.git
cd fika
composer install
```

Next you need to make a copy of the `.env.example` file and rename it to `.env` inside your project root.

``` bash
cp .env.example .env
```

Generate application key

```
php artisan key:generate
```

Start development server

```
php artisan serve
```

## Testing

``` bash
composer test
```

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
