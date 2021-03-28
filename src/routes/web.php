<?php

use Illuminate\Support\Facades\Route;
use LLoadoutEnforce\Http\Livewire\Access;
use LLoadoutEnforce\Http\Livewire\Menu;
use LLoadoutEnforce\Http\Livewire\Menus;
use LLoadoutEnforce\Http\Livewire\Permission;
use LLoadoutEnforce\Http\Livewire\Permissions;
use LLoadoutEnforce\Http\Livewire\Role;
use LLoadoutEnforce\Http\Livewire\Roles;
use LLoadoutEnforce\Http\Livewire\User;
use LLoadoutEnforce\Http\Livewire\Users;

Route::middleware(['web', 'auth'])->group(function () {

    Route::get('/users', Users::class)->name('users.index');
    Route::get('/user/detail/{user?}', User::class)->whereNumber('id')->name('users.edit');

    Route::get('/roles', Roles::class)->name('users.roles');
    Route::get('/role/{role?}', Role::class)->name('role.edit');

    Route::get('/access', Access::class)->name('users.access');

    Route::get('/permissions', Permissions::class)->name('developers.permissions');
    Route::get('/permission/{permission?}', Permission::class)->name('permission');

    Route::get('/menus', Menus::class)->name('developers.menus');
    Route::get('/menu/{menu?}', Menu::class)->name('menu');

});
