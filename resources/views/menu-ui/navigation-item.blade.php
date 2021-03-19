<div class="w-60">
    @foreach($menu->menu as $__menu)
        <x-jet-dropdown-link href="{{ route('users.index') }}">
            {{ $__menu->name }}
        </x-jet-dropdown-link>
        @if ($__menu->menu->count())
            <div class="absolute z-50 mt-2">
                @include('LLoadoutEnforce-views::menu-ui.navigation-item', array('menu' => $__menu))
            </div>
        @endif
    @endforeach
</div>
