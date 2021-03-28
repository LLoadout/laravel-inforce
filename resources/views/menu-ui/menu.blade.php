<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if(!$menu->id) {{ __('New') }} @endif
            {{ __('Menu') }}
            @if($menu->id): {{ $menu->name }} @endif

        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <x-jet-form-section submit="updateMenu">
            <x-slot name="title">
                {{ __('Menu') }}
            </x-slot>

            <x-slot name="description">
                {{ __('Define the menu properties') }}

            </x-slot>

            <x-slot name="form">
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="name" value="{{ __('Menu name') }}"/>
                    <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="menu.name" autocomplete="name"/>
                    <x-jet-input-error for="permission.name" class="mt-2"/>
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="name" value="{{ __('Menu parent') }}"/>
                    <select wire:model.defer="menu.parent_id" id="parent_id" name="parent_id" autocomplete="activity_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                        <option value="0">{{ __('Choose') }}</option>

                        @foreach($parents as $id => $label)
                            <option value="{{ $id }}">{{ $label }}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="permission.parent" class="mt-2"/>
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="route" value="{{ __('Menu links to route ( empty for no link )') }}"/>
                    <x-jet-input id="route" type="text" class="mt-1 block w-full" wire:model.defer="menu.route" autocomplete="route"/>
                    <x-jet-input-error for="menu.route" class="mt-2"/>
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="sort_order" value="{{ __('Sort order') }}"/>
                    <x-jet-input id="sort_order" type="text" class="mt-1 block w-full" wire:model.defer="menu.sort_order" autocomplete="sort order "/>
                    <x-jet-input-error for="menu.sort_order" class="mt-2"/>
                </div>
            </x-slot>
            <x-slot name="actions">
                <x-jet-action-message class="mr-3" on="saved">
                    {{ __('Saved.') }}
                </x-jet-action-message>

                <x-jet-button wire:loading.attr="disabled">
                    {{ __('Save') }}
                </x-jet-button>
            </x-slot>
        </x-jet-form-section>
        <x-jet-section-border/>

        <x-jet-form-section submit="updateMenu">

            <x-slot name="title">
                {{ __('Perks') }}
            </x-slot>

            <x-slot name="description">
                {{ __('Perks are additional features ') }}
            </x-slot>
            <x-slot name="form">

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="permission" value="{{ __('Permission') }}"/>
                    menu.{{ \Str::slug($menu->name) }}
                </div>
                @if(empty($menu->parent_id))
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="icon" value="{{ __('Menu icon') }}" />
                    <x-jet-input id="icon" type="text" class="mt-1 block w-full" wire:model.defer="menu.icon" autocomplete="icon"/>
                    <x-jet-input-error for="menu.icon" class="mt-2"/>
                </div>
                    @endif
            </x-slot>
            <x-slot name="actions">
                <x-jet-action-message class="mr-3" on="saved">
                    {{ __('Saved.') }}
                </x-jet-action-message>

                <x-jet-button wire:loading.attr="disabled">
                    {{ __('Save') }}
                </x-jet-button>
            </x-slot>
        </x-jet-form-section>
    </div>

</div>