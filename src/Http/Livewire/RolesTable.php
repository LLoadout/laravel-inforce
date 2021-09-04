<?php

namespace LLoadoutInforce\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Spatie\Permission\Models\Role;

class RolesTable extends DataTableComponent
{
    public array $bulkActions = [
        'deleteSelected' => 'Delete selected',
    ];

    public function query(): Builder
    {
        return Role::query()
            ->when($this->getFilter('search'), fn ($query, $term) => $query->where('name', 'like', '%'.$term.'%'));
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
        return route('role.edit', $row);
    }

    public function deleteSelected()
    {
        if ($this->selectedRowsQuery->count() > 0) {
            $this->selectedRowsQuery->delete();
        }
    }
}
