<?php

use Illuminate\Support\Facades\Route;
use LLoadoutInforce\Http\Livewire\Menu;
use LLoadoutInforce\Http\Livewire\Menus;
use LLoadoutInforce\Http\Livewire\Permission;
use LLoadoutInforce\Http\Livewire\Permissions;
use LLoadoutInforce\Http\Livewire\Role;
use LLoadoutInforce\Http\Livewire\Roles;
use LLoadoutInforce\Http\Livewire\User;
use LLoadoutInforce\Http\Livewire\Users;

Route::prefix('admin')->group(function () {
    Route::middleware(['web', 'auth'])->group(function () {
        Route::get('/users', Users::class)->name('users.index');
        Route::get('/user/detail/{user?}', User::class)->whereNumber('id')->name('users.edit');

        Route::get('/roles', Roles::class)->name('users.roles');
        Route::get('/role/{role?}', Role::class)->name('role.edit');

        Route::get('/permissions', Permissions::class)->name('developers.permissions');
        Route::get('/permission/{permission?}', Permission::class)->name('permission');

        Route::get('/menus', Menus::class)->name('developers.menus');
        Route::get('/menu/{menu?}', Menu::class)->name('menu');
    });
});
