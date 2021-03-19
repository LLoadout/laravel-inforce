<?php
namespace LLoadoutEnforce\Http\Livewire;


use Spatie\Permission\Models\Role;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class RolesTable extends LivewireDatatable
{

    public $exportable = true;


    public function builder()
    {
        return Role::query();
    }


    public function columns()
    {
        return [
            Column::name('id')
                ->label('ID')
                ->searchable()
                ->linkTo('role'),
            Column::name('name')
                ->label('name')
                ->searchable()

        ];
    }
}