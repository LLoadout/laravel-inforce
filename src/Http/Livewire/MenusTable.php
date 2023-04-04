<?php

namespace LLoadoutInforce\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use LLoadoutInforce\Models\Menu;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class MenusTable extends DataTableComponent
{
    public array $bulkActions = [
        'deleteSelected' => 'Delete selected',
    ];

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function ($row) {
                return route('menu', $row);
            });
    }

    public function builder(): Builder
    {
        return Menu::query()
            ->when($this->columnSearch['name'] ?? null, fn ($query, $value) => $query->where('menus.name', 'like', '%' . $value . '%'))
            ->when($this->columnSearch['route'] ?? null, fn ($query, $value) => $query->where('menus.route', 'like', '%' . $value . '%'))
            ->whereEditable(true);
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id'),
            Column::make('Name', 'name')
                ->sortable()->searchable(),
            Column::make('Route', 'route')
                ->sortable()->searchable(),
        ];
    }

    public function deleteSelected()
    {
        if (filled($this->getSelected()) > 0) {
            Menu::whereIn('id', $this->getSelected())->delete();
            $this->clearSelected();
        }
    }
}
