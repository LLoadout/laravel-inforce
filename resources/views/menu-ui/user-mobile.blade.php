<div class="border-t border-gray-200"></div>

<div class="block px-4 py-2 text-xs text-gray-400">
    {{ __('User Management') }}
</div>
<x-responsive-nav-link href="{{ route('users.index') }}">
    {{ __('Manage Users') }}
</x-responsive-nav-link>
<x-responsive-nav-link href="{{ route('users.roles') }}">
    {{ __('Manage Roles') }}
</x-responsive-nav-link>

