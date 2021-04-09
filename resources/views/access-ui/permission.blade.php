@foreach($access as $permission => $permissionId)
    @if(is_array($permissionId))
        <div class=" items-center mx-4 bg-gray-300 flex items-center px-3 py-2 my-2 text-sm font-medium rounded-md">{{ $permission }}</div>
        @include('LLoadoutInforce-views::access-ui.permission', ["access" => $permissionId])
    @else

        <label class=" items-center mx-4 bg-gray-100 flex items-center px-3 py-2 my-2 text-sm font-medium rounded-md">
            <input @if(isset($user) && $user->hasPermissionTo($permissionId)  && !$user->hasAnyDirectPermission([$permissionId])) disabled style="background-color:lightgrey" @endif type="checkbox" class="form-checkbox" {{ $selectedModel->hasPermissionTo($permissionId) ? 'checked' : '' }} wire:click="assign({{ $permissionId }})">
            <span class="ml-2">{{ $permission }}</span>
        </label>

    @endif
@endforeach
