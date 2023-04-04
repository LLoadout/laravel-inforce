<?php

namespace LLoadoutInforce\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\TextFilter;
use Spatie\Permission\Models\Role;

class RolesTable extends DataTableComponent
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

        return Role::query()
            ->when($this->columnSearch['name'] ?? null, fn ($query, $value) => $query->where('role.name', 'like', '%' . $value . '%'));
    }

    public function columns(): array
    {
        return [
            Column::make('Name', 'name')
                ->sortable()->searchable(),
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
