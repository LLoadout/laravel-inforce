<?php

namespace LLoadoutEnforce\Http\Livewire;

use Livewire\Component;
use LLoadoutEnforce\Http\Livewire\Traits\HandlesPermissions;

class Role extends Component
{
    use HandlesPermissions;

    public $role;

    protected function rules()
    {
        return [
            'role.name' => 'required|string',
        ];
    }

    public function mount(\Spatie\Permission\Models\Role $role)
    {
        $this->role = $role;
        $this->forRole($this->role);
    }

    public function render()
    {
        return view('LLoadoutEnforce-views::user-ui.role');
    }

    public function delete()
    {
        $this->role->delete();
    }

    public function updateRole()
    {
        $this->validate();
        $this->role->save();
        $this->emit('saved');

    }

}
