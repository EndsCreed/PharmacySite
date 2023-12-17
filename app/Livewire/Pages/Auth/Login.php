<?php

namespace App\Livewire\Pages\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Auth\UserProvider;
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
        if (in_array($this->role, ['web','doctor','patient','pharmacy', true])) {
            $this->validate();

            $key = '';
            if ($this->role === 'web')
                $key = 'email';
            elseif ($this->role === 'pharmacy')
                $key = 'id';
            else
                $key = 'sin';

            if (! Auth::guard($this->role)->attempt([$key => $this->identity, 'password' => $this->password], false)) {
                throw ValidationException::withMessages([
                    'identity' => trans('auth.failed'),
                ]);
            }

            $role = $this->role;

            Session::put('role', $role);
            Auth::setDefaultDriver($role);

            Session::regenerate();

            $this->redirect(
                session('url.intended', route($role.'.home')),
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
