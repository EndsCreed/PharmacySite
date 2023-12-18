<?php

namespace App\Livewire\Pages;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Home extends Component {

    public $user;

    public function mount($user = NULL) {
        $this->user = Auth::getUser();
    }

    public function render()
    {
        return view('livewire.pages.home');
    }
}
