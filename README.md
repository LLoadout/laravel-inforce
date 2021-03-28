![Downloads](https://img.shields.io/packagist/dt/lloadout/enforce.svg?style=flat-square)

# Enforce

With LLoadout Enforce you will kickstart your Laravel development when using Laravel Jetstream and Spatie permissions.

## Installation

```shell
composer require lloadout/enforce
```

## Users, roles and permissions
LLoadout Enforce will add a ui to manage your users, roles, permission and menus.  It will also provide you with
a ui to link users to roles and assign permissions to roles.  

## Navigation

It provides a ui for navigation management and navigation permissions.

### Assets 

LLoadout enforce uses some default menus and permissions, these can be created via the provided migrations and seeder.

```shell
php artisan vendor:publish --tag=LLoadoutEnforce-migrations
php artisan vendor:publish --tag=LLoadoutEnforce-seeders
php artisan db:seed --class=EnforceSeeder
```shell

### Publish optional assets

```shell
php artisan vendor:publish --tag=LLoadoutEnforce-views
```

