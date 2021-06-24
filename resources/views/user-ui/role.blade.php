<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        @if(!$role->id) {{ __('New') }} @endif
        {{ __('Role') }}
        @if($role->id): {{ $role->name }} @endif
        @if($role->id)
            <a href="{{ route('role.edit') }}" class="float-right bg-blue-500 text-white font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button">
                + {{ __('New') }}
            </a>
        @endif
    </h2>
</x-slot>
<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <x-jet-form-section submit="updateRole">
        <x-slot name="title">
            {{ __('Role') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Give your role a short and clear name') }}
        </x-slot>

        <x-slot name="form">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="name" value="{{ __('Role name') }}"/>
                <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="role.name" autocomplete="name"/>
                <x-jet-input-error for="role.name" class="mt-2"/>
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="description" value="{{ __('Role description') }}"/>
                <x-jet-input id="description" type="text" class="mt-1 block w-full" wire:model.defer="role.description" autocomplete="description"/>
                <x-jet-input-error for="role.description" class="mt-2"/>
            </div>
        </x-slot>
        <x-slot name="actions">
            <x-jet-action-message class="mr-3" on="saved">
                {{ __('Saved.') }}
            </x-jet-action-message>

            <x-jet-button wire:loading.attr="disabled" wire:target="photo">
                {{ __('Save') }}
            </x-jet-button>
        </x-slot>
    </x-jet-form-section>
    <x-jet-section-border/>
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <x-jet-section-title>
            <x-slot name="title">
                {{ __('Permissions') }}
            </x-slot>
            <x-slot name="description">
                {{ __('These are the role specific permissions') }}
            </x-slot>
        </x-jet-section-title>
        <div class="mt-5 md:mt-0 md:col-span-2">
            <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
                @include('LLoadoutInforce-views::user-ui.access')
            </div>
        </div>
    </div>
</div>
