<?php

namespace LLoadoutInforce\Http\Livewire\Traits;

use App\Models\User;
use LLoadoutInforce\Services\Grouper;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


trait HandlesPermissions
{

    public $selectedModel;
    public $permissionGroups;
    public $selectedGroup = null;
    public $access        = [];


    public function forRole(Role $role)
    {
        $this->selectedGroup = null;
        $this->forModel($role);
    }

    public function forUser(User $user)
    {
        $this->forModel($user);
    }

    private function forModel($model)
    {
        $this->selectedModel    = $model;
        $this->access           = Permission::all();
        $this->permissionGroups = app(Grouper::class)->exec($this->access->pluck('name', 'id'));
    }

    public function forGroup($group)
    {
        $this->selectedGroup = $group;
        $this->access        = $this->permissionGroups[$group];
    }

    public function assign($permission)
    {
        if ($this->selectedModel->hasPermissionTo($permission)) {
            $this->selectedModel->revokePermissionTo($permission);
        } else {
            $this->selectedModel->givePermissionTo($permission);
        }
    }

    public function assignAll()
    {
        $this->selectedModel->givePermissionTo(Permission::where('name', 'like', $this->selectedGroup . ".%")->get());
    }
}