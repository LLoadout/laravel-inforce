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

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function ($row) {
                return route('permission', $row);
            });
    }

    public function builder(): Builder
    {
        return Permission::query()
            ->when($this->columnSearch['name'] ?? null, fn($query, $value) => $query->where('permissions.name', 'like', '%' . $value . '%'));
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id'),
            Column::make('Name', 'name')
                ->sortable()->searchable(),
        ];
    }

    public function deleteSelected()
    {
        if (filled($this->getSelected()) > 0) {
            Permission::whereIn('id', $this->getSelected())->delete();
            $this->clearSelected();
        }
    }
}
