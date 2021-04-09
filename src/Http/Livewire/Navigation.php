<?php

namespace LLoadoutInforce\Http\Livewire;

use Livewire\Component;
use LLoadoutInforce\Http\Livewire\Traits\ShowPerks;

class Navigation extends Component
{
    use  ShowPerks;

    protected $listeners = ['menuUpdated' => 'render'];


    public function render()
    {
        $menus = $this->getMenus();
        return view('LLoadoutInforce-views::menu-ui.navigation', compact('menus'));
    }

    private function getMenus()
    {
        return \LLoadoutInforce\Models\Menu::whereNull('parent_id')->with('menu')->orderBy('sort_order')->get()->toBase();
    }

}
