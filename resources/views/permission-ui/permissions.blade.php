<div class="py-3">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-3">
        <div class="grid grid-cols-2">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Permissions') }}
            </h2>
            <div>
                <a href="{{ route('permission') }}" class="float-right bg-blue-500 text-white font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button">
                    + {{ __('New') }}
                </a>
            </div>
        </div>
    </div>


    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-2">
            <livewire:permissions-table/>
        </div>
    </div>
</div>

