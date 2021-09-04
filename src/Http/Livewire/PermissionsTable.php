<?php

namespace LLoadoutInforce\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Spatie\Permission\Models\Permission;

class PermissionsTable extends DataTableComponent
{
    public $addRoute = "permission";

    public array $bulkActions = [
        'deleteSelected' => 'Delete selected',
    ];

    public function query(): Builder
    {
        return Permission::query()
            ->when($this->getFilter('search'), fn ($query, $term) => $query->where('name', 'like', '%'.$term.'%'))->whereEditable(true);
    }

    public function columns(): array
    {
        return [
            Column::make('Name', 'name')
                ->sortable(),
        ];
    }

    public function getTableRowUrl($row): string
    {
        return route('permission', $row);
    }

    public function deleteSelected()
    {
        if ($this->selectedRowsQuery->count() > 0) {
            $this->selectedRowsQuery->delete();
        }
    }
}
