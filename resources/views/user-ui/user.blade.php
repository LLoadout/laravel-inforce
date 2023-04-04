<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        @if(!$user->id) {{ __('New') }} @endif
        {{ __('User') }}
        @if($user->id): {{ $user->name }} @endif
        @if($user->id)
            <a href="{{ route('users.edit') }}" class="float-right bg-blue-500 text-white font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button">
                + {{ __('New') }}
            </a>
        @endif
    </h2>
</x-slot>

<div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <x-form-section submit="updateUser">
        <x-slot name="title">
            {{ __('Profile information') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Update your account\'s profile information and email address.') }}
        </x-slot>

        <x-slot name="form">
            <div class="col-span-6 sm:col-span-4">
                <x-label for="name" value="{{ __('User name') }}"/>
                <x-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="user.name" autocomplete="name"/>
                <x-input-error for="user.name" class="mt-2"/>
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-label for="email" value="{{ __('Email') }}"/>
                <x-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="user.email" autocomplete="name"/>
                <x-input-error for="user.email" class="mt-2"/>
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-label for="role" value="{{ __('Role') }}"/>
                <div class="bg-white rounded-md -space-y-px">
                @foreach($roles as $role)
                    <!-- Checked: "bg-indigo-50 border-indigo-200 z-10", Not Checked: "border-gray-200" -->
                        <label class="@if(in_array($role->id,$userRoles)) bg-indigo-50 border-indigo-200 z-10 @else border-gray-200  @endif @if($loop->first) rounded-tl-md rounded-tr-md @endif @if($loop->last) rounded-bl-md rounded-br-md @endif relative border p-4 flex cursor-pointer">
                            <input type="checkbox" value="{{ $role->id }}" wire:model="userRoles" class="invisible" aria-labelledby="privacy-setting-{{ $loop->iteration }}-label" aria-describedby="privacy-setting-{{ $loop->iteration }}-description">
                            <div class="flex flex-col">
                                <!-- Checked: "text-indigo-900", Not Checked: "text-gray-900" -->
                                <span id="privacy-setting-{{ $loop->iteration }}-label" class="text-gray-900 block text-sm font-medium">{{ $role->name }}</span>
                                <!-- Checked: "text-indigo-700", Not Checked: "text-gray-500" -->
                                <span id="privacy-setting-{{ $loop->iteration }}-description" class="text-gray-500 block text-sm">{{ $role->description }}</span>
                            </div>
                        </label>
                    @endforeach
                </div>
                <x-input-error for="user.email" class="mt-2"/>


                <x-input-error for="role" class="mt-2"/>
            </div>
        </x-slot>
        @if($user->id)
            <x-slot name="actions">
                <x-action-message class="mr-3" on="saved">
                    {{ __('Saved.') }}
                </x-action-message>

                <x-button wire:loading.attr="disabled">
                    {{ __('Save') }}
                </x-button>
            </x-slot>
        @endif
    </x-form-section>
    <x-section-border/>

    <x-form-section submit="updatePassword">
        <x-slot name="title">
            {{ __('Password') }}
        </x-slot>

        <x-slot name="description">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </x-slot>

        <x-slot name="form">
            <div class="col-span-6 sm:col-span-4">
                <x-label for="password" value="{{ __('Password') }}"/>
                <x-input id="password" type="password" class="mt-1 block w-full" wire:model.defer="credentials.password" autocomplete="name"/>
                <x-input-error for="credentials.password" class="mt-2"/>
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-label for="password_confirmation" value="{{ __('Confirm password') }}"/>
                <x-input id="password_confirmation" type="password" class="mt-1 block w-full" wire:model.defer="credentials.password_confirmation" autocomplete="name"/>
                <x-input-error for="credentials.password_confirmation" class="mt-2"/>
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
    <x-section-border/>
    @if($showPerks)
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <x-section-title>
                <x-slot name="title">
                    {{ __('Permissions') }}
                </x-slot>
                <x-slot name="description">
                    {{ __('These are the user specific permissions , grayed out permissions are set via a role and cannot be changed for the user.') }}
                </x-slot>
            </x-section-title>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-md">
                    @include('LLoadoutInforce-views::user-ui.access')
                </div>
            </div>
        </div>
    @endif

</div>
