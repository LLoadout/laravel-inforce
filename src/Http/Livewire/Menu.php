<?php

namespace LLoadoutEnforce\Http\Livewire;

use Livewire\Component;

class Menu extends Component
{

    public $menu;
    public $parents;

    protected function rules()
    {
        return [
            'menu.name'       => 'required|string',
            'menu.route'      => 'nullable|string',
            'menu.icon'       => 'nullable|string',
            'menu.permission' => 'nullable|string',
            'menu.parent_id'  => 'nullable|integer'
        ];
    }

    public function mount(\LLoadoutEnforce\Models\Menu $menu)
    {
        $this->menu    = $menu;
        $this->parents = \LLoadoutEnforce\Models\Menu::pluck('name', 'id')->toArray();
    }

    public function updatedMenuName()
    {
        $this->menu->permission ??= "menu." . \Str::slug($this->menu->name);
    }

    public function updatedMenuPermission()
    {
        $this->menu->permission = is_string($this->menu->permission) && $this->menu->permission === '' ? null : $this->menu->permission;
    }

    public function render()
    {
        $menus = \LLoadoutEnforce\Models\Menu::whereNull('parent_id')->with('menu')->get();
        return view('LLoadoutEnforce-views::menu-ui.menu', compact('menus'));

    }

    public function delete()
    {
        $this->menu->delete();
    }

    public function updatePermission()
    {
        $this->validate();
        $this->menu->save();
        $this->emit('menuUpdated');
        $this->emit('saved');

    }

}
