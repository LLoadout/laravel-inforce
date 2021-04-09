<?php

namespace LLoadoutInforce\Http\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Component;
use LLoadoutInforce\Http\Livewire\Traits\HandlesPermissions;
use LLoadoutInforce\Http\Livewire\Traits\ShowPerks;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Access extends Component
{
    use HandlesPermissions, ShowPerks;


    public function render(): View
    {
        $roles = Role::all();
        return view('LLoadoutInforce-views::access-ui.access', compact('roles'));
    }
}
