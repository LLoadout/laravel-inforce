<?php

namespace LLoadoutEnforce\Http\Livewire;


use Livewire\Component;

class Permission extends Component
{

    public $permission;

    protected function rules()
    {
        return [
            'permission.name' => 'required|string',
        ];
    }

    public function mount(\Spatie\Permission\Models\Permission $permission)
    {
        $this->permission = $permission;
    }

    public function render()
    {
        return view('LLoadoutEnforce-views::permission-ui.permission');
    }

    public function delete()
    {
        $this->permission->delete();
    }

    public function updatePermission()
    {
        $this->validate();
        $this->permission->save();
        $this->emit('saved');

    }

}
