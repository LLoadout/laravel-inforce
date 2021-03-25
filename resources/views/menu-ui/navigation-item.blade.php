<ul class="rounded-md ring-1 ring-black ring-opacity-5 py-1 bg-white z-50 w-48 rounded-md shadow-lg  bg-white rounded-sm transform scale-0 group-hover:scale-100 absolute transition duration-150 ease-in-out origin-right">
    @foreach($menu->menu as $__menu)
        @if (!is_array($__menu->menu) &&  $__menu->menu->count())
            <li class="rounded-sm relative px-4 py-2 hover:bg-gray-100">
                <button class="w-full text-left flex items-center outline-none focus:outline-none">
                    <span class="pr-1 flex-1">{{ $__menu->name }}</span>
                    <span class="mr-auto">
              <svg class="fill-current h-4 w-4 transition duration-150 ease-in-out" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
              </svg>
            </span>
                </button>
                <ul class="bg-white border rounded-sm absolute top-0 right-0 transition duration-150 ease-in-out origin-top-left min-w-32">
                    @include('LLoadoutEnforce-views::menu-ui.navigation-item', array('menu' => $__menu))
                </ul>
            </li>
        @else
            <li class="px-3 py-1 hover:bg-gray-100 block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                <a class="" href="{{ Route::has($__menu->route) ? route($__menu->route) : '#' }}">{{ $__menu->name }}</a></li>
        @endif
    @endforeach
</ul>

