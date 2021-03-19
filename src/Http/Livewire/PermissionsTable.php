<?php
namespace LLoadoutEnforce\Http\Livewire;


use Spatie\Permission\Models\Permission;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class PermissionsTable extends LivewireDatatable
{

    public $exportable = true;


    public function builder()
    {
        return Permission::query();
    }


    public function columns()
    {
        return [
            Column::name('id')
                ->label('ID')
                ->searchable()
                ->linkTo('permission'),
            Column::name('name')
                ->label('name')
                ->searchable()

        ];
    }
}