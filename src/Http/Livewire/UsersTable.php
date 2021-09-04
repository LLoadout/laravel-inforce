<?php

namespace LLoadoutInforce\Http\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class UsersTable extends DataTableComponent
{
    public $addRoute = "users.edit";

    public array $bulkActions = [
        'deleteSelected' => 'Delete selected',
    ];

    public function query(): Builder
    {
        return User::query()
            ->when($this->getFilter('search'), fn ($query, $term) => $query->where('name', 'like', '%'.$term.'%')->orWhere('email', 'like', '%'.$term.'%'));
    }

    public function columns(): array
    {
        return [
            Column::make('Name', 'name')
                ->sortable(),
            Column::make('Email', 'email')
                ->sortable(),
        ];
    }

    public function getTableRowUrl($row): string
    {
        return route('users.edit', $row);
    }

    public function deleteSelected()
    {
        if ($this->selectedRowsQuery->count() > 0) {
            $this->selectedRowsQuery->delete();
        }
    }
}
