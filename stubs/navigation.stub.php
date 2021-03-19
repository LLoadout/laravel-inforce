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
                    <x-jet-dropdown-link href="{{ route('users.access') }}">
                        {{ __('Manage access') }}
                    </x-jet-dropdown-link>
                </div>
            </x-slot>
        </x-jet-dropdown>
    </div>
</div>