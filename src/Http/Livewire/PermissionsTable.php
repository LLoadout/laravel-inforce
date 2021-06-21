<?php

namespace LLoadoutInforce\Http\Livewire;

use App\User;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class PermissionsTable extends DataTableComponent
{

    public $addRoute          = "permission";

    public array $bulkActions = [
        'deleteSelected' => 'Delete selected',
    ];

    public function query(): Builder
    {
        return Permission::query()
            ->when($this->getFilter('search'), fn ($query, $term) => $query->where('name', 'like', '%'.$term.'%'));
    }

    public function columns(): array
    {

        return [
            Column::make('ID', 'id')
                ->sortable(),
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