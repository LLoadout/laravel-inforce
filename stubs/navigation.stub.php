<div class="hidden sm:flex sm:items-center sm:ml-6">
    <div class="ml-3 relative text-sm">
        <x-dropdown align="right" width="60">
            <x-slot name="trigger">
                {{ __('User management') }}
            </x-slot>
            <x-slot name="content">
                <div class="w-60">
                    <x-dropdown-link href="{{ route('users.index') }}">
                        {{ __('Manage users') }}
                    </x-dropdown-link>
                    <x-dropdown-link href="{{ route('users.roles') }}">
                        {{ __('Manage roles') }}
                    </x-dropdown-link>
                    <x-dropdown-link href="{{ route('users.access') }}">
                        {{ __('Manage access') }}
                    </x-dropdown-link>
                </div>
            </x-slot>
        </x-dropdown>
    </div>
</div>