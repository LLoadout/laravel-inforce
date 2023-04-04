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
        $this->setPrimaryKey('id');
    }

    public function builder(): Builder
    {
        return Menu::query()
            ->when($this->columnSearch['name'] ?? null, fn($query, $value) => $query->where('menus.name', 'like', '%' . $value . '%'))
            ->when($this->columnSearch['route'] ?? null, fn($query, $value) => $query->where('menus.route', 'like', '%' . $value . '%'))
            ->whereEditable(true);
    }

    public function columns(): array
    {
        return [
            Column::make('Name', 'name')
                ->sortable()->searchable(),
            Column::make('Route', 'route')
                ->sortable()->searchable(),
        ];
    }

    public function getTableRowUrl($row): string
    {
        return route('menu', $row);
    }

    public function deleteSelected()
    {
        if ($this->selectedRowsQuery->count() > 0) {
            $this->selectedRowsQuery->delete();
        }
    }
}
