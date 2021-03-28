<?php

namespace LLoadoutEnforce\Http\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;
use LLoadoutEnforce\Http\Livewire\Traits\HandlesPermissions;
use LLoadoutEnforce\Http\Livewire\Traits\ShowPerks;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Access extends Component
{
    use HandlesPermissions, ShowPerks;


    public function render(): View
    {
        $roles = Role::all();
        return view('LLoadoutEnforce-views::access-ui.access', compact('roles'));
    }
}
