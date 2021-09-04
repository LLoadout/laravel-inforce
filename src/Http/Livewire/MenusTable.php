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

    public function query(): Builder
    {
        return Menu::query()
            ->when($this->getFilter('search'), fn ($query, $term) => $query->where('name', 'like', '%'.$term.'%')->orWhere('route', 'like', '%'.$term.'%'))->whereEditable(true);
    }

    public function columns(): array
    {
        return [
            Column::make('Name', 'name')
                ->sortable(),
            Column::make('Route', 'route')
                ->sortable(),
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
