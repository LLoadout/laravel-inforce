<?php

namespace LLoadoutEnforce\Http\Livewire;


use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use LLoadoutEnforce\Models\Menu;

class MenusTable extends LivewireDatatable
{

    public $exportable = true;


    public function builder()
    {
        return Menu::query();
    }


    public function columns()
    {
        return [
            Column::name('id')
                ->label('ID')
                ->searchable()
                ->linkTo('menu'),
            Column::name('name')
                ->label('name')
                ->searchable(),
            Column::name('route')
                ->label('route')
                ->searchable()

        ];
    }
}