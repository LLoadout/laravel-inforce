<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        @if(!$user->id) {{ __('New') }} @endif
        {{ __('User') }}
        @if($user->id): {{ $user->name }} @endif
    </h2>
</x-slot>

<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <x-jet-form-section submit="updateUser">
        <x-slot name="title">
            {{ __('Profile information') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Update your account\'s profile information and email address.') }}
        </x-slot>

        <x-slot name="form">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="name" value="{{ __('User name') }}"/>
                <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="user.name" autocomplete="name"/>
                <x-jet-input-error for="user.name" class="mt-2"/>
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="email" value="{{ __('Email') }}"/>
                <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="user.email" autocomplete="name"/>
                <x-jet-input-error for="user.email" class="mt-2"/>
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="role" value="{{ __('Role') }}"/>
                <select wire:model="userRoles" multiple class='w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm'>
                    <option value="">{{ __('Choose') }}</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
                <x-jet-input-error for="role" class="mt-2"/>
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

    <x-jet-form-section submit="updateUser">
        <x-slot name="title">
            {{ __('Password') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </x-slot>

        <x-slot name="form">
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="password" value="{{ __('Password') }}"/>
                <x-jet-input id="password" type="password" class="mt-1 block w-full" wire:model.defer="user.password" autocomplete="name"/>
                <x-jet-input-error for="user.password" class="mt-2"/>
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm password') }}"/>
                <x-jet-input id="password_confirmation" type="password" class="mt-1 block w-full" wire:model.defer="user.password_confirmation" autocomplete="name"/>
                <x-jet-input-error for="user.password_confirmation" class="mt-2"/>
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
    @if($showPerks)
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <x-jet-section-title>
            <x-slot name="title">
                {{ __('Permissions') }}
            </x-slot>
            <x-slot name="description">
                {{ __('These are the user specific permissions , grayed out permissions are set via a role and cannot be changed for the user.') }}
            </x-slot>
        </x-jet-section-title>
        <div class="mt-5 md:mt-0 md:col-span-2">
            <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
            @include('LLoadoutEnforce-views::user-ui.access')
            </div>
        </div>
    </div>
        @endif

</div>
