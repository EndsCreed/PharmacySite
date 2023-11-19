<?php

namespace App\Livewire\Pages\Auth;

use Illuminate\Validation\Rule;
use Livewire\Component;

class Login extends Component
{
    #[Rule('required|string')]
    public string $identity = '';

    #[Rule('required|string')]
    public string $password = '';

    #[Rule('required|string')]
    public string $role = 'patient';

    public function save() {
        if ($this->role === '')
    }

    public function render()
    {
        return view('livewire.pages.auth.login');
    }
}
