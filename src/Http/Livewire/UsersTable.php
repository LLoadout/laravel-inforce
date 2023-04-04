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

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function ($row) {
                return route('users.edit', $row);
            });
    }

    public function builder(): Builder
    {
        return User::query()
            ->when($this->columnSearch['name'] ?? null, fn ($query, $value) => $query->where('name', 'like', '%' . $value . '%'))
            ->when($this->columnSearch['email'] ?? null, fn ($query, $value) => $query->where('email', 'like', '%' . $value . '%'));
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id'),
            Column::make('Name', 'name')
                ->sortable()->searchable(),
            Column::make('Email', 'email')
                ->sortable()->searchable(),
        ];
    }

    public function deleteSelected()
    {
        if (filled($this->getSelected()) > 0) {
            User::whereIn('id', $this->getSelected())->delete();
            $this->clearSelected();
        }
    }
}
