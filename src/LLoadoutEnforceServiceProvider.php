<?php namespace LLoadoutEnforce;

use App\Http\Livewire\Roles;
use Livewire\Livewire;
use LLoadoutEnforce\Http\Livewire\Access;
use LLoadoutEnforce\Http\Livewire\Menu;
use LLoadoutEnforce\Http\Livewire\MenusTable;
use LLoadoutEnforce\Http\Livewire\Navigation;
use LLoadoutEnforce\Http\Livewire\Permission;
use LLoadoutEnforce\Http\Livewire\PermissionsTable;
use LLoadoutEnforce\Http\Livewire\Role;
use LLoadoutEnforce\Http\Livewire\RolesTable;
use LLoadoutEnforce\Http\Livewire\User;
use LLoadoutEnforce\Http\Livewire\UsersTable;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LLoadoutEnforceServiceProvider extends PackageServiceProvider
{

    public function configurePackage(Package $package): void
    {
        $package->name('laravel-permission-ui');
        $this->loadAssets()->publishAssets();
    }

    private function loadAssets()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'LLoadoutEnforce-views');
        $this->loadLivewireComponents();
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        return $this;
    }

    private function publishAssets()
    {

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/loadout'),
        ], 'LLoadoutEnforce-views');

        $this->publishes([
            __DIR__ . '/../database/seeders' => base_path('database/seeders'),
        ], 'LLoadoutEnforce-seeders');

        $this->publishes([
            __DIR__.'/../database/migrations/create_enforce_tables.php.stub' => base_path('database/migrations/'. date('Y_m_d_His').'_create_enforce_tables.php'),
        ], 'LLoadoutEnforce-migrations');

        return $this;
    }

    private function loadLivewireComponents()
    {
        Livewire::component('access', Access::class);
        Livewire::component('permission', Permission::class);
        Livewire::component('permissions-table', PermissionsTable::class);

        Livewire::component('menu', Menu::class);
        Livewire::component('menus-table', MenusTable::class);
        Livewire::component('navigation', Navigation::class);

        Livewire::component('roles-table', RolesTable::class);
        Livewire::component('users-table', UsersTable::class);
        Livewire::component('user', User::class);
        Livewire::component('role', Role::class);
    }
}
