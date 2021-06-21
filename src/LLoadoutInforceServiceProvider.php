<?php namespace LLoadoutInforce;

use App\Http\Livewire\Roles;
use Livewire\Livewire;
use LLoadoutInforce\Http\Livewire\Access;
use LLoadoutInforce\Http\Livewire\Menu;
use LLoadoutInforce\Http\Livewire\MenusTable;
use LLoadoutInforce\Http\Livewire\Navigation;
use LLoadoutInforce\Http\Livewire\Permission;
use LLoadoutInforce\Http\Livewire\PermissionsTable;
use LLoadoutInforce\Http\Livewire\Role;
use LLoadoutInforce\Http\Livewire\RolesTable;
use LLoadoutInforce\Http\Livewire\User;
use LLoadoutInforce\Http\Livewire\UsersTable;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LLoadoutInforceServiceProvider extends PackageServiceProvider
{

    public function configurePackage(Package $package): void
    {
        $package->name('laravel-permission-ui');
        $this->loadAssets()->publishAssets();
    }

    private function loadAssets()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'LLoadoutInforce-views');
        $this->loadLivewireComponents();
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        return $this;
    }

    private function publishAssets()
    {

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/LLoadoutInforce-views'),
        ], 'LLoadoutInforce-views');

        $this->publishes([
            __DIR__ . '/../database/seeders' => base_path('database/seeders'),
        ], 'LLoadoutInforce-seeders');

        $this->publishes([
            __DIR__ . '/../resources/lang' => resource_path('lang'),
        ], 'LLoadoutInforce-langs');

        $this->publishes([
            __DIR__.'/../database/migrations/create_inforce_tables.php.stub' => base_path('database/migrations/'. date('Y_m_d_His').'_create_inforce_tables.php'),
            __DIR__.'/../database/migrations/update_roles_table.php.stub' => base_path('database/migrations/'. date('Y_m_d_His').'_update_roles_table.php'),
        ], 'LLoadoutInforce-migrations');

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
