<div class="inline-flex">
    @foreach($menus as $key => $menu)
        @can($menu->permission)
        <div wire:key="menu-{{ $key }}" class="hidden sm:flex sm:items-center sm:ml-10 border-b-2 border-transparent hover:text-gray-700 hover:border-gray-300">
            <div class="relative text-sm" x-data="{ open: false }">
                <div class="group inline-block">
                    <i class="absolute top-1.5 -left-3.5 text-gray-500" style="width: 15px;height:15px">{!! $menu->icon !!}</i>
                    @if($showPerks)
                        <a class="flex absolute top-1.5 -left-3.5 text-gray-500" href="{{ route('menu',$menu->id) }}">
                            <svg style="height: 10px;margin-top: 2px;margin-right:10px" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                            </svg>
                        </a>
                    @endif
                    <a @click="open = ! open" @click.away="open = false" @close.stop="open = false" href="{{ Route::has($menu->route) ? route($menu->route) : '#' }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700">
                        {{  $menu->name }}
                    </a>

                    @if($menu->menu->count() > 0)
                        <div x-show="open"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             style="display: none;"
                             @click="open = false">
                        @include("LLoadoutEnforce-views::menu-ui.navigation-item", ['menu' => $menu])
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @endcan
    @endforeach
</div>

<style>
    /* since nested groupes are not supported we have to use
       regular css for the nested dropdowns
    */
    li > ul {
        transform: translatex(100%) scale(0)
    }

    li:hover > ul {
        transform: translatex(101%) scale(1)
    }

    li > button svg {
        transform: rotate(-90deg)
    }

    li:hover > button svg {
        transform: rotate(-270deg)
    }



    .scale-0 {
        transform: scale(0)
    }

    .min-w-32 {
        min-width: 8rem
    }
</style>