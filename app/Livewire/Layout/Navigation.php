<?php

namespace App\Livewire\Layout;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Navigation extends Component
{

    public function logout() {
        Auth::guard(Auth::guard()->name)->logout();

        Session::invalidate();
        Session::regenerateToken();

        $this->redirect(
            session('url.intended', route('welcome')),
            navigate: true
        );
    }
    public function render()
    {
        return view('livewire.layout.navigation');
    }
}
