<?php

namespace App\Livewire\Pages\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Rule;
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
        if (in_array($this->role, ['admin','doctor','patient','pharmacy', true])) {
            $this->validate();

            if (! Auth::guard($this->role)->attempt($this->only('identity', 'password'), false)) {
                throw ValidationException::withMessages([
                    'identity' => trans('auth.failed'),
                ]);
            }

            Session::regenerate();

            $this->redirect(
                session('url.intended', RouteServiceProvider::HOME),
                navigate: true
            );
        } else {
            redirect(route('welcome'));
        }
    }

    public function render()
    {
        return view('livewire.pages.auth.login');
    }
}
