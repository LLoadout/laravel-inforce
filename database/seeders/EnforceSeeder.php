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
        DB::table('permissions')->delete();
        DB::table('menus')->delete();
        DB::table('model_has_permissions')->delete();
        DB::table('role_has_permissions')->delete();
        DB::table('roles')->delete();

        collect([ 'admin', 'user'])->each(function ($name) {
            DB::table('roles')->insert([
                'name'       => $name,
                'guard_name' => 'web'
            ]);
        });

        $sortOrder = 1;
        collect(["customers", "suppliers", "products", "news"])->each(function ($section) use ($sortOrder) {
            Menu::create([
                'name'       => ucfirst($section),
                'sort_order' => $sortOrder++
            ]);

            Permission::create([
                'name'       => 'menu.' . $section,
                'guard_name' => 'web'
            ]);

            collect(['create', 'read', 'update', 'delete'])->each(function ($permission) use ($section) {
                Permission::create([
                    'name'       => $section . "." . $permission,
                    'guard_name' => 'web'
                ]);
            });
        });


        $usersMenu = Menu::create([
            'name'       => __('User management'),
            'sort_order' => $sortOrder++
        ]);

        Permission::create([
            'name'       => 'menu.user-management',
            'guard_name' => 'web'
        ]);

        Menu::create([
            'parent_id'  => $usersMenu->id,
            'name'       => __('Manage users'),
            'route'      => 'users.index',
            'sort_order' => $sortOrder++
        ]);

        Permission::create([
            'name'       => 'menu.user-management.manage-users',
            'guard_name' => 'web'
        ]);

        Menu::create([
            'parent_id'  => $usersMenu->id,
            'name'       => __('Manage roles'),
            'route'      => 'users.roles',
            'sort_order' => $sortOrder++
        ]);

        Permission::create([
            'name'       => 'menu.user-management.manage-roles',
            'guard_name' => 'web'
        ]);

        Menu::create([
            'parent_id'  => $usersMenu->id,
            'name'       => __('Manage access'),
            'route'      => 'users.access',
            'sort_order' => $sortOrder++
        ]);

        Permission::create([
            'name'       => 'menu.user-management.manage-access',
            'guard_name' => 'web'
        ]);

        $devMenu = Menu::create([
            'name'       => __('Developer menu'),
            'sort_order' => $sortOrder++
        ]);

        Permission::create([
            'name'       => 'menu.developer-menu',
            'guard_name' => 'web'
        ]);

        Menu::create([
            'parent_id'  => $devMenu->id,
            'name'       => __('Permissions'),
            'route'      => 'developers.permissions',
            'sort_order' => $sortOrder++
        ]);

        Permission::create([
            'name'       => 'menu.developer-menu.permissions',
            'guard_name' => 'web'
        ]);

        Menu::create([
            'parent_id'  => $devMenu->id,
            'name'       => __('Menus'),
            'route'      => 'developers.menus',
            'sort_order' => $sortOrder++
        ]);

        Permission::create([
            'name'       => 'menu.developer-menu.menus',
            'guard_name' => 'web'
        ]);

        $developer = Role::create(['name' => 'superuser']);

        $developer->givePermissionTo('menu.user-management');
        $developer->givePermissionTo('menu.user-management.manage-users');
        $developer->givePermissionTo('menu.user-management.manage-roles');
        $developer->givePermissionTo('menu.user-management.manage-access');

        $developer->givePermissionTo('menu.developer-menu');
        $developer->givePermissionTo('menu.developer-menu.permissions');
        $developer->givePermissionTo('menu.developer-menu.menus');

        $user = User::create(['name' => 'John Doe' , 'email' => 'john@doe.com', 'password' => \Hash::make('password')]);

        User::all()->each(function ($user) {
            $user->assignRole('superuser');
        });



    }
}
