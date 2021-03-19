    @foreach($menus as $menu)
        <div class="hidden sm:flex sm:items-center sm:ml-6">
            <div class="ml-3 relative text-sm">
                <x-jet-dropdown align="right" width="60">
                    <x-slot name="trigger">
                        {{  $menu->name }}
                    </x-slot>
                    <x-slot name="content">
                        @include("LLoadoutEnforce-views::menu-ui.navigation-item", ['menu' => $menu])
                    </x-slot>
                </x-jet-dropdown>
            </div>
        </div>
    @endforeach
    <div class="hidden sm:flex sm:items-center sm:ml-6">
        <div class="ml-3 relative text-sm">
            <x-jet-dropdown align="right" width="60" :active="request()->routeIs('users.*')">
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
                        <x-jet-dropdown-link href="{{ route('users.access') }}">
                            {{ __('Manage access') }}
                        </x-jet-dropdown-link>
                    </div>
                </x-slot>
            </x-jet-dropdown>
        </div>
    </div>
    <div class="hidden sm:flex sm:items-center sm:ml-6">
        <div class="ml-3 relative text-sm">
            <x-jet-dropdown align="right" width="60" :active="request()->routeIs('users')">
                <x-slot name="trigger">
                    {{ __('Developer menu') }}
                </x-slot>
                <x-slot name="content">
                    <div class="w-60">
                        <x-jet-dropdown-link href="{{ route('permissions') }}">
                            {{ __('Permissions') }}
                        </x-jet-dropdown-link>
                        <x-jet-dropdown-link href="{{ route('menus') }}">
                            {{ __('Menus') }}
                        </x-jet-dropdown-link>
                    </div>
                </x-slot>
            </x-jet-dropdown>
        </div>
    </div>



