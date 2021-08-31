<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use LLoadoutInforce\Models\Menu;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class InforceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('permissions')->truncate();
        DB::table('users')->truncate();
        DB::table('menus')->truncate();
        DB::table('model_has_permissions')->truncate();
        DB::table('role_has_permissions')->truncate();
        DB::table('roles')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        collect(['admin', 'user'])->each(function ($name) {
            DB::table('roles')->insert([
                'name'       => $name,
                'guard_name' => 'web'
            ]);
        });

        $sortOrder = 999;

        $usersMenu = Menu::create([
            'name'       => 'User management',
            'permission' => 'menu.user-management',
            'sort_order' => $sortOrder++,
            'editable'   => false
        ]);

        Permission::create([
            'name'       => 'menu.user-management',
            'guard_name' => 'web',
            'editable'   => false
        ]);

        Menu::create([
            'parent_id'  => $usersMenu->id,
            'name'       => 'Manage users',
            'route'      => 'users.index',
            'permission' => 'menu.user-management.manage-users',
            'sort_order' => $sortOrder++,
            'editable'   => false
        ]);

        Permission::create([
            'name'       => 'menu.user-management.manage-users',
            'guard_name' => 'web',
            'editable'   => false
        ]);

        Menu::create([
            'parent_id'  => $usersMenu->id,
            'name'       => 'Manage roles',
            'route'      => 'users.roles',
            'permission' => 'menu.user-management.manage-roles',
            'sort_order' => $sortOrder++,
            'editable'   => false
        ]);

        Permission::create([
            'name'       => 'menu.user-management.manage-roles',
            'guard_name' => 'web',
            'editable'   => false
        ]);

        $devMenu = Menu::create([
            'name'       => 'Developer menu',
            'permission' => 'menu.developer-menu',
            'sort_order' => $sortOrder++,
            'editable'   => false
        ]);

        Permission::create([
            'name'       => 'menu.developer-menu',
            'guard_name' => 'web',
            'editable'   => false
        ]);

        Menu::create([
            'parent_id'  => $devMenu->id,
            'name'       => 'Permissions',
            'route'      => 'developers.permissions',
            'permission' => 'menu.developer-menu.permissions',
            'sort_order' => $sortOrder++,
            'editable'   => false
        ]);

        Permission::create([
            'name'       => 'menu.developer-menu.permissions',
            'guard_name' => 'web',
            'editable'   => false
        ]);

        Menu::create([
            'parent_id'  => $devMenu->id,
            'name'       => 'Menus',
            'route'      => 'developers.menus',
            'permission' => 'menu.developer-menu.menus',
            'sort_order' => $sortOrder++,
            'editable'   => false
        ]);

        Permission::create([
            'name'       => 'menu.developer-menu.menus',
            'guard_name' => 'web',
            'editable'   => false
        ]);

        $developer = Role::create(['name' => 'superuser']);

        $developer->givePermissionTo('menu.user-management');
        $developer->givePermissionTo('menu.user-management.manage-users');
        $developer->givePermissionTo('menu.user-management.manage-roles');

        $developer->givePermissionTo('menu.developer-menu');
        $developer->givePermissionTo('menu.developer-menu.permissions');
        $developer->givePermissionTo('menu.developer-menu.menus');

        $user = User::create(['name' => 'John Doe', 'email' => 'john@doe.com', 'password' => \Hash::make('password')]);

        User::all()->each(function ($user) {
            $user->assignRole('superuser');
        });


    }
}
