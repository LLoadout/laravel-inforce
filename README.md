![Downloads](https://img.shields.io/packagist/dt/lloadout/enforce.svg?style=flat-square)

# Enforce

With LLoadout Enforce you will kickstart your Laravel development when using Laravel Jetstream and Spatie permissions.

## Users, roles and permissions

LLoadout Enforce will add a ui for managing users, roles, permission and menus.  It will also provide you with
an ui to link users to roles and assign permissions to roles.

## Installation

```shell
composer require lloadout/enforce
```

If you are starting from a new installation and need to install Laravel Jetstream or Spatie Permissions , you need to do the additional steps 
documented at the end of this documentation.

### Assets 

LLoadout enforce uses some default menus and permissions, these can be created via the provided migrations and seeder.

```shell
php artisan vendor:publish --tag=LLoadoutEnforce-migrations
php artisan vendor:publish --tag=LLoadoutEnforce-seeders
php artisan migrate
php artisan db:seed --class=EnforceSeeder
```

You also have to publish the datatables components configuration to set the theme to tailwind

```shell
php artisan vendor:publish --provider="Rappasoft\LaravelLivewireTables\LaravelLivewireTablesServiceProvider" --tag=config
```
Change the `theme` config setting to `tailwind` in the published file.


### Publish optional assets

```shell
php artisan vendor:publish --tag=LLoadoutEnforce-views
```

## Logging in 

LLoadout enforce will default create a user with username of `john@doe.com` and the password `password`

## Navigation

It provides a ui for navigation management and navigation permissions.

Therefore you have to add this tag after the dashboard navigation div in navigation.blad.php

```php 
 <livewire:navigation/>
```


## Installing Laravel Jetstream ( if you didn't already install it )

```php 
composer require laravel/jetstream

php artisan jetstream:install livewire
```

After this you have to install and build the assets

```shell
npm install
npm run dev
```

## Installing Laravel Permissions ( if you didn't already install it )

if you hadn't already installed Laravel Permissions then you should first publish the config file and migrations.

php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"


First, add the Spatie\Permission\Traits\HasRoles trait to your User model(s):

```php
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
use HasRoles;

    // ...
}
```
