<div class="inline-flex">
    @foreach($menus as $key => $menu)
        <div wire:key="menu-{{ $key }}" class="hidden sm:flex sm:items-center sm:ml-10 border-b-2 border-transparent hover:text-gray-700 hover:border-gray-300">
            <div class="relative text-sm">
                <div class="group inline-block">
                    <i class="absolute top-1.5 -left-3.5 text-gray-500" style="width: 15px;height:15px">{!! $menu->icon !!}</i>
                    <a href="{{ Route::has($menu->route) ? route($menu->route) : '#' }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 transition duration-150 ease-in-out">
                        {{  $menu->name }}
                    </a>
                    @if($menu->menu->count() > 0)
                        @include("LLoadoutEnforce-views::menu-ui.navigation-item", ['menu' => $menu])
                    @endif
                </div>
            </div>
        </div>
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

    /* Below styles fake what can be achieved with the tailwind config
       you need to add the group-hover variant to scale and define your custom
       min width style.
         See https://codesandbox.io/s/tailwindcss-multilevel-dropdown-y91j7?file=/index.html
         for implementation with config file
    */
    .group:hover .group-hover\:scale-100 {
        transform: scale(1)
    }

    .group:hover .group-hover\:-rotate-180 {
        transform: rotate(180deg)
    }

    .scale-0 {
        transform: scale(0)
    }

    .min-w-32 {
        min-width: 8rem
    }
</style>