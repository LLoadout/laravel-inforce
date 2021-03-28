<?php

namespace LLoadoutEnforce\Http\Livewire;

use Hash;
use Livewire\Component;
use LLoadoutEnforce\Http\Livewire\Traits\HandlesPermissions;
use LLoadoutEnforce\Http\Livewire\Traits\ShowPerks;
use Spatie\Permission\Models\Role;

class User extends Component
{
    use HandlesPermissions, ShowPerks;

    public $user;
    public $userRoles = [];

    protected function rules()
    {
        return [
            'user.name'                  => 'required|string',
            'user.email'                 => ['required', 'email', 'not_in:' . $this->user->id],
            'user.password'              => 'required|confirmed',
            'user.password_confirmation' => 'required'
        ];
    }

    public function mount(\App\Models\User $user)
    {
        $this->user = $user;
        $this->forUser($this->user);
        $this->userRoles = $this->user->roles->pluck('id');
    }

    public function render()
    {
        $roles = Role::all();
        return view('LLoadoutEnforce-views::user-ui.user', compact('roles'));
    }

    public function delete()
    {
        $this->user->delete();
    }

    public function updateUser()
    {
        $this->validate();

        $this->handlePassword();
        $this->user->save();
        $this->user->syncRoles([$this->userRoles]);

    }

    private function handlePassword()
    {
        $this->user->password = Hash::make($this->user->password);
        //TODO : maybe this can be done better , remove because otherwise stored to db
        unset($this->user->password_confirmation);
    }

}
