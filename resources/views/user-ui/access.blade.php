<div class="container mx-auto">
    <div class="grid grid-cols-2 rounded-md ">
        <div>
            <nav aria-label="Sidebar">
                @foreach($permissionGroups as $name => $permissionGroup)
                    <a href="#" wire:key="{{ $name  }}" wire:click="forGroup('{{ $name }}')" class="@if($this->selectedGroup === $name) bg-gray-100 @endif py-4 m-4 text-gray-600 hover:bg-gray-50 hover:text-gray-900 flex items-center px-3 py-2 text-sm font-medium rounded-md">
                        <span class="truncate">{{ $name }}</span>
                    </a>
                @endforeach
            </nav>

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