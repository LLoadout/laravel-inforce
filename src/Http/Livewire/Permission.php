<?php

namespace LLoadoutInforce\Http\Livewire;

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
        return view('LLoadoutInforce-views::permission-ui.permission');
    }

    public function delete()
    {
        $this->permission->delete();
    }

    public function updatePermission()
    {
        $this->validate();
        if ($this->permission->isDirty()) {
            $original = $this->permission->getOriginal('name');
            //update menu with this permission to new permission
            \LLoadoutInforce\Models\Menu::wherePermission($original)->update(['permission' => $this->permission->name]);
        }

        $this->permission->save();
        $this->emit('saved');
    }
}
