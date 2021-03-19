# TODO

* put the navigation part in code via package

## Installation of ui package

### Clone this repo somewhere on your computer 

for example in /Users/your-user/packages

### Installing package

add this to composer.json ( change folder with location of cloned repo )

```json

    "repositories": [
            {
                "type": "path",
                "url": "/Users/your-user/packages/laravel-permissions-ui"
            }
    ],
        
```

### Require package with

```shell
composer require deltasolutions-kifed/laravel-permission-ui
```

### Publish installation file

```shell
php artisan vendor:publish --tag=LLoadoutEnforce-installer
```

### Run installation file

```shell
bash install.sh
```

### Add navigation 

add this to 'navigation-menu.blade.php'
```php 

<div class="hidden sm:flex sm:items-center sm:ml-6">
    <div class="ml-3 relative text-sm">
        <x-jet-dropdown align="right" width="60">
            <x-slot name="trigger">
                {{ __('User management') }}
            </x-slot>
            <x-slot name="content">
                <div class="w-60">
                    <x-jet-dropdown-link href="{{ route('users.index') }}">
                        {{ __('Manage users') }}
                    </x-jet-dropdown-link>
                    <x-jet-dropdown-link href="{{ route('users.roles') }}">
                        {{ __('Manage roles') }}
                    </x-jet-dropdown-link>
                    <x-jet-dropdown-link href="{{ route('users.permissions') }}">
                        {{ __('Manage permissions') }}
                    </x-jet-dropdown-link>
                </div>
            </x-slot>
        </x-jet-dropdown>
    </div>
</div>

```

### Permissions

if you manually create extra permissions in database than you need to run following code 

```shell
php artisan permission:cache-reset
```