<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->delete();
        DB::table('model_has_permissions')->delete();
        DB::table('role_has_permissions')->delete();
        DB::table('roles')->delete();

        collect(['superuser', 'admin', 'user'])->each(function ($name) {
            DB::table('roles')->insert([
                'name'       => $name,
                'guard_name' => 'web'
            ]);
        });

        collect(["customers", "suppliers", "products", "news"])->each(function ($section) {
            collect(['create', 'read', 'update', 'delete'])->each(function ($permission) use ($section) {
                DB::table('permissions')->insert([
                    'name'       => $section . "." . $permission,
                    'guard_name' => 'web'
                ]);
            });
        });
    }
}
