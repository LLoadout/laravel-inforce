<?php

namespace LLoadoutEnforce\Http\Livewire;

use Livewire\Component;
use LLoadoutEnforce\Http\Livewire\Traits\ShowPerks;

class Navigation extends Component
{
    use  ShowPerks;

    protected $listeners = ['menuUpdated' => 'render'];


    public function render()
    {
        $menus = $this->getMenus();
        return view('LLoadoutEnforce-views::menu-ui.navigation', compact('menus'));
    }

    private function getMenus()
    {
        return \LLoadoutEnforce\Models\Menu::whereNull('parent_id')->with('menu')->orderBy('sort_order')->get()->toBase();
    }

}
