<?php

namespace LLoadoutEnforce\Http\Livewire;

use Livewire\Component;

class Navigation extends Component
{
    protected $listeners = ['menuUpdated' => 'render'];

    public function render()
    {
        $menus = $this->getMenus();
        return view('LLoadoutEnforce-views::menu-ui.navigation', compact('menus'));
    }

    private function getMenus()
    {
        $menus = \LLoadoutEnforce\Models\Menu::whereNull('parent_id')->with('menu')->get()->toBase();
        $menus->push($this->buildUsermenu());
        $menus->push($this->buildDevelopermenu());
        return $menus;
    }

    private function buildUsermenu()
    {
        $menu       = new \LLoadoutEnforce\Models\Menu();
        $menu->name = __('User management');

        $subMenu        = new \LLoadoutEnforce\Models\Menu();
        $subMenu->name  = __('Manage users');
        $subMenu->route = 'users.index';
        $menu->menu[] = $subMenu;

        $subMenu        = new \LLoadoutEnforce\Models\Menu();
        $subMenu->name  = __('Manage roles');
        $subMenu->route = 'users.roles';
        $menu->menu[]   = $subMenu;

        $subMenu        = new \LLoadoutEnforce\Models\Menu();
        $subMenu->name  = __('Manage access');
        $subMenu->route = 'users.access';
        $menu->menu[]   = $subMenu;

        return $menu;
    }

    private function buildDevelopermenu()
    {
        $menu       = new \LLoadoutEnforce\Models\Menu();
        $menu->name = __('Developer menu');

        $subMenu        = new \LLoadoutEnforce\Models\Menu();
        $subMenu->name  = __('Permissions');
        $subMenu->route = 'permissions';
        $menu->menu[] = $subMenu;

        $subMenu        = new \LLoadoutEnforce\Models\Menu();
        $subMenu->name  = __('Menus');
        $subMenu->route = 'menus';
        $menu->menu[]   = $subMenu;

        return $menu;
    }

}
