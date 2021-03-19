<?php

namespace LLoadoutEnforce\Http\Livewire;


use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class UsersTable extends LivewireDatatable
{

    public $exportable = true;


    public function builder()
    {
        return User::query();
    }

    public function roles(): BelongsToMany
    {
        return $this->morphToMany(
            config('permission.models.role'),
            'model',
            config('permission.table_names.model_has_roles'),
            config('permission.column_names.model_morph_key'),
            'role_id'
        );
    }


    public function columns()
    {
        return [
            Column::name('id')
                ->label('ID')
                ->searchable()
                ->linkTo('user/detail'),
            Column::name('name')
                ->label('name')
                ->searchable(),
            Column::name('email')
                ->label('email')
                ->searchable(),
//            Column::name('roles.name')
//                ->label('role')

        ];
    }
}