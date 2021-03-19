<?php

namespace LLoadoutEnforce\Http\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;
use LLoadoutEnforce\Services\Grouper;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Access extends Component
{
    public $selectedRole;
    public $permissionGroups;
    public $selectedGroup = null;
    public $access   = [];

    private $returnGrouped;


    public function mount($grouped = true)
    {
        $this->returnGrouped = $grouped;
    }

    public function render(): View
    {
        $roles = Role::all();
        return view('LLoadoutEnforce-views::access-ui.access', compact('roles'));
    }

    public function forRole(Role $role)
    {
        $this->selectedRole     = $role;
        $this->selectedGroup    = null;
        $this->access      = Permission::all();
        $this->permissionGroups = app(Grouper::class)->exec($this->access->pluck('name', 'id'));
    }

    public function withGroup($group)
    {
        $this->selectedGroup = $group;
        $this->access   = $this->permissionGroups[$group];
    }

    public function assign($permission)
    {
        if ($this->selectedRole->hasPermissionTo($permission)) {
            $this->selectedRole->revokePermissionTo($permission);
        } else {
            $this->selectedRole->givePermissionTo($permission);
        }
    }

    public function assignAll()
    {
        $this->selectedRole->givePermissionTo(Permission::where('name', 'like', $this->selectedGroup . ".%")->get());
    }
}
