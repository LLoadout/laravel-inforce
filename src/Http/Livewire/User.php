<?php

namespace LLoadoutInforce\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use LLoadoutInforce\Http\Livewire\Traits\HandlesPermissions;
use LLoadoutInforce\Http\Livewire\Traits\ShowPerks;
use Spatie\Permission\Models\Role;

class User extends Component
{
    use HandlesPermissions, ShowPerks;

    public $user;
    public $credentials;
    public $userRoles = [];

    protected function rules()
    {
        return [
            'user.name'  => 'required|string',
            'user.email' => ['required', 'email', 'not_in:' . $this->user->id],
        ];
    }

    public function mount(\App\Models\User $user)
    {
        $this->user = $user;
        $this->forUser($this->user);
        $this->userRoles = array_map('strval', $this->user->roles->pluck('id')->toArray());
    }

    public function render()
    {
        $roles = Role::all();
        return view('LLoadoutInforce-views::user-ui.user', compact('roles'));
    }

    public function delete()
    {
        $this->user->delete();
    }

    public function updateUser()
    {
        $this->validate();

        $this->user->save();
        $this->user->syncRoles([$this->userRoles]);

    }

    public function updatePassword()
    {
        $validatedData = $this->validate([
                'credentials.password'              => 'required|confirmed',
                'credentials.password_confirmation' => 'required'
            ] + $this->rules());

        $this->user->forceFill([
            'password' => \Illuminate\Support\Facades\Hash::make($this->credentials['password']),
        ])->save();

        //if edited user is same as logged in user
        if ($this->user->id == auth()->user()->id)
            Auth::login($this->user);

    }


}
