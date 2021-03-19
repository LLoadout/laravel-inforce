<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Access') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="container mx-auto">
                <div class="grid grid-cols-3 rounded-md ">
                    <div>
                        <!-- This example requires Tailwind CSS v2.0+ -->
                        <nav aria-label="Sidebar">
                            @foreach($roles as $role)
                                <a href="#" wire:click="forRole({{ $role->id }})" class="@if(optional($this->selectedRole)->id === $role->id) bg-gray-100 @endif py-4 m-4 text-gray-600 hover:bg-gray-50 hover:text-gray-900 flex items-center px-3 py-2 text-sm font-medium rounded-md">
                                    <span class="truncate">{{ $role->name }}</span>
                                </a>
                            @endforeach
                        </nav>

                    </div>
                    <div>
                        @if($selectedRole)
                            <nav wire:key="{{ $selectedRole->id  }}" aria-label="Sidebar">
                                @foreach($permissionGroups as $name => $permissionGroup)
                                    <a href="#" wire:key="{{ $name  }}" wire:click="withGroup('{{ $name }}')" class="@if($this->selectedGroup === $name) bg-gray-100 @endif py-4 m-4 text-gray-600 hover:bg-gray-50 hover:text-gray-900 flex items-center px-3 py-2 text-sm font-medium rounded-md">
                                        <span class="truncate">{{ $name }}</span>
                                    </a>
                                @endforeach
                            </nav>
                        @endif
                    </div>
                    <div>
                        @if($selectedGroup)
                            @if($access)
                                <label class=" items-center mx-4 bg-gray-300 flex items-center px-3 py-2 my-2 text-sm font-medium rounded-md">
                                    <input type="checkbox" class="form-checkbox" wire:click="assignAll()">
                                    <span class="ml-2">{{ __('Select all') }}</span>
                                </label>
                            @endif

                            @include('LLoadoutEnforce-views::access-ui.permission')

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
