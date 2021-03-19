<?php

namespace LLoadoutEnforce\Http\Livewire;

use Livewire\Component;

class Navigation extends Component
{
    public    $menus;
    protected $listeners = ['menuUpdated' => 'mount'];



    public function mount()
    {
        $this->getMenus();
    }

    public function render()
    {
        return view('LLoadoutEnforce-views::menu-ui.navigation');
    }

    private function getMenus()
    {
        $this->menus = \LLoadoutEnforce\Models\Menu::whereNull('parent_id')->with('menu')->get();
    }


}
