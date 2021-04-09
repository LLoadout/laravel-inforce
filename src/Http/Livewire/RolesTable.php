<?php

namespace LLoadoutInforce\Http\Livewire;

use App\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Spatie\Permission\Models\Role;

class RolesTable extends TableComponent
{
    use HtmlComponents;

    public $addRoute          = "role.edit";
    public $clearSearchButton = true;

    public function query(): Builder
    {
        return Role::query();
    }

    public function columns(): array
    {

        return [
            Column::make('ID', 'id')
                ->searchable()
                ->sortable()
                ->format(function (Role $model) {
                    return $this->linkRoute('role.edit', $model->id, $model->id);
                }),
            Column::make('Name', 'name')
                ->searchable()
                ->sortable(),
        ];

    }
}