#!/bin/bash
rm database/migrations/*create_permission*

php artisan vendor:publish --tag=LLoadoutEnforce-views
php artisan vendor:publish --tag=LLoadoutEnforce-seeders
php artisan vendor:publish --tag=LLoadoutEnforce-stubs

#install Jetstream with livewire
php artisan jetstream:install livewire
npm install && npm run dev

#publish spatie permission assets
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"

sed -i $'s/use TwoFactorAuthenticatable;/use TwoFactorAuthenticatable;\\\n    use \\\\Spatie\\\\Permission\\\\Traits\\\\HasRoles;/' app/Models/User.php

rm navigation.stub.php