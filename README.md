![Downloads](https://img.shields.io/packagist/dt/lloadout/inforce.svg?style=flat-square)

<p align="center">
    <img src="https://github.com/LLoadout/assets/blob/master/LLoadout_inforce.png" width="500" title="LLoadout logo">
</p>

# LLoadout

LLoadout is your loadout for Laravel.  It helps you with tips , code examples and packages to make you a better Laravel developer.

# LLoadout inforce

With LLoadout Inforce you will kickstart your Laravel development when using Laravel Jetstream and Spatie permissions.

## Users, roles and permissions

LLoadout inforce will add a ui for managing users, roles, permission and menus.  It will also provide you with
an ui to link users to roles and assign permissions to roles.

## Installation

```shell
composer require lloadout/inforce
```

If you are starting from a new installation and need to install Laravel Jetstream, Spatie Permissions or Laravel Livewire datatables , you need to do the additional steps 
documented at the end of this documentation.

### Assets 

LLoadout inforce uses some default menus and permissions, these can be created via the provided migrations and seeder.

```shell
php artisan vendor:publish --tag=LLoadoutInforce-migrations
php artisan vendor:publish --tag=LLoadoutInforce-seeders
php artisan migrate
php artisan db:seed --class=InforceSeeder
```

You also have to publish the datatables components configuration to set the theme to tailwind

```shell
php artisan vendor:publish --provider="Rappasoft\LaravelLivewireTables\LaravelLivewireTablesServiceProvider" --tag=config
```
Change the `theme` config setting to `tailwind` in the published file.


### Publish optional assets

```shell
php artisan vendor:publish --tag=LLoadoutInforce-views
```

## Navigation

It provides a ui for navigation management and navigation permissions.

Therefore you have to add this tag after the dashboard navigation div in navigation-menu.blade.php

```php 
 <livewire:navigation/>
```

## Logging in

LLoadout inforce will default create a user with username of `john@doe.com` and the password `password`


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

## Installing Laravel Livewire datatables

because the datatables don't include a tailwind ui i've created a fork.  The fork is in pull request but while it's still open you have to include my 
version as a root dependencie in your project.

add this to your composer.json 

```shell
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/LLoadout/laravel-livewire-tables"
        }
    ],
```

add this in your required packages 

```shell
"rappasoft/laravel-livewire-tables": "dev-tailwind as 0.3.3"
```

publish the config file 
```shell
php artisan vendor:publish --provider="Rappasoft\LaravelLivewireTables\LaravelLivewireTablesServiceProvider" --tag=config
```

then change "theme" to "tailwind" in /config/laravel-livewire-tables.php
