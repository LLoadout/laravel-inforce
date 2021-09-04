![Tests](https://github.com/LLoadout/inforce/workflows/tests/badge.svg)
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

### manage roles 

you can manage roles and assign permissions to the roles 

<p align="center">
    <img src="https://github.com/LLoadout/assets/blob/master/inforce/roles.png"  title="LLoadout inforce">
</p>

### manage users 

you can manage users and assign them a role.  You can also assign permissions on user level.

<p align="center">
    <img src="https://github.com/LLoadout/assets/blob/master/inforce/users.png"  title="LLoadout inforce">
</p>

### manage menus

you can manage menus

<p align="center">
    <img src="https://github.com/LLoadout/assets/blob/master/inforce/menus.png"  title="LLoadout inforce">
</p>



## Installation


## Installing Laravel Jetstream, the Livewire version 

Laravel Jetstream is a requirement for this package, if you haven't allready install it i refer
to the docs of Jetstream to install it.

https://jetstream.laravel.com/2.x/installation.html#livewire

## Installing Laravel Permissions

If you hadn't already installed Laravel Permissions , install it first, therefor I refer to the docs of Spatie

https://spatie.be/docs/laravel-permission/v4/installation-laravel

Attention : don't forget to read the prerequisites : https://spatie.be/docs/laravel-permission/v4/prerequisites

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
php artisan vendor:publish --tag=LLoadoutInforce-langs
```

## Navigation

It provides a ui for navigation management and navigation permissions.

Therefore you have to add this tag after the Navigation Links section navigation-menu.blade.php. Default on line 19

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

# Documentation 

Via the permissions menu you can create your permissions, they are stored in the database.  Via the user or role menu it is possible to assign a permission to a role or a user.

It is also possible to create menu's and corresponding permissions for the menu's.  Giving users or roles access to the menu's via the roles and users management.
