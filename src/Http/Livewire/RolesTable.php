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

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function ($row) {
                return route('role.edit', $row);
            });
    }

    public function builder(): Builder
    {
        return Role::query()
            ->when($this->columnSearch['name'] ?? null, fn ($query, $value) => $query->where('role.name', 'like', '%' . $value . '%'));
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')->deselected(),
            Column::make('Name', 'name')
                ->sortable()->searchable(),
        ];
    }

    public function deleteSelected()
    {
        if (filled($this->getSelected()) > 0) {
            Role::whereIn('id', $this->getSelected())->delete();
            $this->clearSelected();
        }
    }
}
