<?php

namespace App\Http\Controllers;

use App\Livewire\Pages\Auth\Login;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function create() {
        return view(Login::class);
    }
}
