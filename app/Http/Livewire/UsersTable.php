<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UsersTable extends Component
{
    public $selectedAccessLevel;

    public function render()
    {
        return view('livewire.users-table', ['users' => User::all()]);
    }

    public function changeRole(User $user, $value) {
        $user->access_level = $value;

        $user->save();

        $this->emit('saved');
    }
}
