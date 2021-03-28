<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        @if(!$permission->id) {{ __('New') }} @endif
        {{ __('Permission') }}
        @if($permission->id): {{ $permission->name }} @endif
    </h2>
</x-slot>
<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <x-jet-form-section submit="updatePermission">
        <x-slot name="title">
            {{ __('Permission') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Permissions can have a dotted notation') }}
<br/>
            @verbatim
                <br />@can(@endverbatim'{{ $permission->name }}'@verbatim)<br/>
                &nbsp;&nbsp;//<br/>
                @endcan<br/>
            @endverbatim
        </x-slot>

        <x-slot name="form">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="name" value="{{ __('Permission name') }}"/>
                <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="permission.name" autocomplete="name"/>
                <x-jet-input-error for="permission.name" class="mt-2"/>
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
</div>
