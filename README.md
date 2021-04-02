![Downloads](https://img.shields.io/packagist/dt/lloadout/enforce.svg?style=flat-square)

# Enforce

With LLoadout Enforce you will kickstart your Laravel development when using Laravel Jetstream and Spatie permissions.

## Installation

```shell
composer require lloadout/enforce
```

## Installing Laravel Jetstream ( if you didn't already install it )

```php 
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

## Users, roles and permissions
LLoadout Enforce will add a ui to manage your users, roles, permission and menus.  It will also provide you with
a ui to link users to roles and assign permissions to roles.  

## Navigation

It provides a ui for navigation management and navigation permissions.

Therefore you have to add this tag after the dashboard navigation div in navigation.blad.php

```php 
 <livewire:navigation/>
```

### Assets 

LLoadout enforce uses some default menus and permissions, these can be created via the provided migrations and seeder.

```shell
php artisan vendor:publish --tag=LLoadoutEnforce-migrations
php artisan vendor:publish --tag=LLoadoutEnforce-seeders
php artisan migrate
php artisan db:seed --class=EnforceSeeder
```

### Publish optional assets

```shell
php artisan vendor:publish --tag=LLoadoutEnforce-views
```

## Logging in 

LLoadout enforce will default create a user with username of `john@doe.com` and the password `password`
