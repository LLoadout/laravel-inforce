<?php

namespace LLoadoutInforce\Http\Livewire;

use Livewire\Component;
use LLoadoutInforce\Http\Livewire\Traits\HandlesPermissions;

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
        return view('LLoadoutInforce-views::user-ui.role');
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
