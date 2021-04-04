<?php

namespace LLoadoutEnforce\Http\Livewire;

use App\User;
use Illuminate\Database\Eloquent\Builder;
use LLoadoutEnforce\Models\Menu;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;

class MenusTable extends TableComponent
{
    use HtmlComponents;

    public $addRoute          = "menu";
    public $clearSearchButton = true;

    public function query(): Builder
    {
        return Menu::query();
    }

    public function columns(): array
    {

        return [
            Column::make('ID', 'id')
                ->searchable()
                ->sortable()
                ->format(function (Menu $model) {
                    return $this->linkRoute('menu', $model->id, $model->id);
                }),
            Column::make('Name', 'name')
                ->searchable()
                ->sortable(),
            Column::make('Route', 'route')
                ->searchable()
                ->sortable(),
        ];

    }
}