<?php

namespace LLoadoutEnforce\Http\Livewire;

use App\User;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;

class PermissionsTable extends TableComponent
{
    use HtmlComponents;

    public $addRoute          = "permission";
    public $clearSearchButton = true;

    public function query(): Builder
    {
        return Permission::query();
    }

    public function columns(): array
    {

        return [
            Column::make('ID', 'id')
                ->searchable()
                ->sortable()
                ->format(function (Permission $model) {
                    return $this->linkRoute('permission', $model->id, $model->id);
                }),
            Column::make('Name', 'name')
                ->searchable()
                ->sortable(),
        ];

    }
}