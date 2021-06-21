![Downloads](https://img.shields.io/packagist/dt/lloadout/inforce.svg?style=flat-square)

<p align="center">
    <img src="https://github.com/LLoadout/assets/blob/master/LLoadout_inforce.png" width="500" title="LLoadout logo">
</p>

# LLoadout

LLoadout is your loadout for Laravel.  It helps you with tips , code examples and packages to make you a better Laravel developer.

# LLoadout inforce

With LLoadout Inforce you will kickstart your Laravel development when using Laravel Jetstream and Spatie permissions.

<p align="center">
    <img src="https://github.com/LLoadout/assets/blob/master/inforce/teaser.png"  title="LLoadout inforce">
</p>

## Users, roles and permissions

LLoadout inforce will add a ui for managing users, roles, permission and menus.  It will also provide you with
an ui to link users to roles and assign permissions to roles.

## Installation


## Installing Laravel Jetstream, the Livewire version 

Laravel Jetstream is a requirement for this package, if you haven't allready install it i refer
to the docs of Jetstream to install it.

https://jetstream.laravel.com/2.x/installation.html#livewire

## Installing Laravel Permissions

If you hadn't already installed Laravel Permissions , install it first, therefor I refer to the docs of Spatie

https://spatie.be/docs/laravel-permission/v4/installation-laravel

## Installation of LLoadout inforce 

```shell
composer require lloadout/inforce
```

### Assets 

LLoadout inforce uses some default menus and permissions, these can be created via the provided migrations and seeder.

```shell
php artisan vendor:publish --tag=LLoadoutInforce-migrations
php artisan vendor:publish --tag=LLoadoutInforce-seeders
php artisan migrate
php artisan db:seed --class=InforceSeeder
```

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

## Extending the package

Assume you want to add fields to the user view and want to save the field to the database.  Than you can use the published view and extend the LLoadout user component.
Herefore you have to create your own route to your own created component.

This is the route 

```php
Route::get('/user/detail/{user?}', \App\Http\Livewire\MyUser::class)->whereNumber('id')->name('users.edit'); 
```

This can be your component
```php
<?php

namespace App\Http\Livewire;

use LLoadoutInforce\Http\Livewire\Traits\HandlesPermissions;
use LLoadoutInforce\Http\Livewire\Traits\ShowPerks;

class MyUser extends \LLoadoutInforce\Http\Livewire\User
{


    protected function rules()
    {

        return [
            'user.name'                  => 'required|string',
            'user.email'                 => ['required', 'email', 'not_in:' . $this->user->id],
            'user.password'              => 'required|confirmed',
            'user.password_confirmation' => 'required',
            'user.extrafield'            => 'required'
        ];
    }

}

```

