<?php

namespace LLoadoutInforce\Http\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission;


class Menu extends Component
{

    public  $menu;
    private $parents;

    protected function rules() : array
    {
        return [
            'menu.name'       => 'required|string',
            'menu.route'      => 'nullable|string',
            'menu.icon'       => 'nullable|string',
            'menu.parent_id'  => 'nullable',
            'menu.sort_order' => 'nullable|integer',
        ];
    }

    public function mount(\LLoadoutInforce\Models\Menu $menu) : void
    {
        $this->menu    = $menu;
        $parents       = \LLoadoutInforce\Models\Menu::with('parent')->get()->map(function ($menu) {
            $prefixInfo = $menu->prefixInfo;
            $order      = (!($menu->parent) ? $menu->sort_order * 100 : ($prefixInfo['root']->sort_order * 100) + $prefixInfo['count']);
            return [
                'id'    => $menu->id,
                'name'  => $prefixInfo['name'],
                'order' => $order
            ];
        });
        $this->parents = $parents->sortBy('order')->pluck('name', 'id')->toArray();
    }

    public function render() : \Illuminate\View\View
    {
        $menus   = \LLoadoutInforce\Models\Menu::with('menu.menu.menu')->orderBy('sort_order')->get();
        $parents = $this->parents;
        return view('LLoadoutInforce-views::menu-ui.menu', compact('menus', 'parents'));
    }

    public function delete() : void
    {
        $this->menu->delete();
    }

    public function updateMenu() : void
    {
        $this->validate();
        $this->menu->parent_id = $this->menu->parent_id == 0 ? null : $this->menu->parent_id;

        if(!$this->menu->permission){
            $this->menu->permission = $this->menu->prefixinfo['path'];
            Permission::firstOrCreate([
                'name'       => $this->menu->permission,
                'guard_name' => 'web'
            ]);
        }

        $this->menu->save();

        $this->mount($this->menu);
        $this->emit('menuUpdated');
        $this->emit('saved');
    }


}
