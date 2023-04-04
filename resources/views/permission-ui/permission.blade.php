<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        @if(!$permission->id) {{ __('New') }} @endif
        {{ __('Permission') }}
        @if($permission->id): {{ $permission->name }} @endif
        @if($permission->id)
            <a href="{{ route('permission') }}" class="float-right bg-blue-500 text-white font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button">
                + {{ __('New') }}
            </a>
        @endif
    </h2>
</x-slot>
<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <x-form-section submit="updatePermission">
        <x-slot name="title">
            {{ __('Permission') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Permissions can have a dotted notation') }}
            <br/>
            @verbatim
                <br/>@can(@endverbatim'{{ $permission->name }}'@verbatim)<br/>
                &nbsp;&nbsp;&nbsp;&nbsp;/* code here */<br/>
                @endcan<br/>
            @endverbatim
        </x-slot>

        <x-slot name="form">
            <div class="col-span-6 sm:col-span-4">
                <x-label for="name" value="{{ __('Permission name') }}"/>
                <x-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="permission.name" autocomplete="name"/>
                <x-input-error for="permission.name" class="mt-2"/>
            </div>
        </x-slot>
        <x-slot name="actions">
            <x-action-message class="mr-3" on="saved">
                {{ __('Saved.') }}
            </x-action-message>

            <x-button wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-form-section>
</div>
