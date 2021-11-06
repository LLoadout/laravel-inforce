<div class="border-t border-gray-200"></div>

<div class="block px-4 py-2 text-xs text-gray-400">
    {{ __('Developer Menu') }}
</div>
<div class="border-t border-gray-100"></div>
<x-jet-responsive-nav-link href="{{ route('developers.permissions') }}">
    {{ __('Permissions') }}
</x-jet-responsive-nav-link>
<x-jet-responsive-nav-link href="{{ route('developers.menus') }}">
    {{ __('Menus') }}
</x-jet-responsive-nav-link>
