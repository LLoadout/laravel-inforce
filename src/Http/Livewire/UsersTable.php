<?php

namespace LLoadoutInforce\Http\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\TableComponent;
use Rappasoft\LaravelLivewireTables\Traits\HtmlComponents;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Spatie\Permission\Models\Role;

class UsersTable extends TableComponent
{
    use HtmlComponents;

    public $addRoute          = "users.edit";
    public $clearSearchButton = true;

    public function query(): Builder
    {
        return User::query();
    }

    public function columns(): array
    {

        return [
            Column::make('ID', 'id')
                ->searchable()
                ->sortable()
                ->format(function (User $model) {
                    return $this->linkRoute('users.edit', $model->id, $model->id);
                }),
            Column::make('Name', 'name')
                ->searchable()
                ->sortable(),
            Column::make('Email', 'email')
                ->searchable()
                ->sortable(),
        ];

    }
}