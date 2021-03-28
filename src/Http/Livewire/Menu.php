<?php

namespace LLoadoutEnforce\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;


class Menu extends Component
{

    public  $menu;
    private $parents;

    protected function rules()
    {
        return [
            'menu.name'       => 'required|string',
            'menu.route'      => 'nullable|string',
            'menu.icon'       => 'nullable|string',
            'menu.parent_id'  => 'nullable',
            'menu.sort_order' => 'nullable|integer',
        ];
    }

    public function mount(\LLoadoutEnforce\Models\Menu $menu)
    {
        $this->menu    = $menu;
        $parents       = \LLoadoutEnforce\Models\Menu::with('parent')->get()->map(function ($menu) {
            $prefixInfo = $menu->prefixInfo;
            $order      = (!($menu->parent) ? $menu->sort_order * 100 : ($prefixInfo['root']->sort_order * 100) + $prefixInfo['count']);
            return [
                'id'         => $menu->id,
                'name'       => $prefixInfo['name'],
                'order'      => $order
            ];
        });
        $this->parents = $parents->sortBy('order')->pluck('name', 'id')->toArray();
    }

    public function render()
    {
        $menus   = \LLoadoutEnforce\Models\Menu::with('menu.menu.menu')->orderBy('sort_order')->get();
        $parents = $this->parents;
        return view('LLoadoutEnforce-views::menu-ui.menu', compact('menus', 'parents'));
    }

    public function delete()
    {
        $this->menu->delete();
    }

    public function updateMenu()
    {
        $this->validate();
        $this->menu->parent_id = $this->menu->parent_id == 0 ? null : $this->menu->parent_id;

        Permission::firstOrCreate([
            'name'       => 'menu.' . \Str::slug($this->menu->name),
            'guard_name' => 'web'
        ]);

        $this->menu->save();
        $this->mount($this->menu);
        $this->emit('menuUpdated');
        $this->emit('saved');
    }


}
