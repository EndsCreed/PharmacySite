<?php

namespace App\Http\Controllers;

use App\Livewire\Pages\Auth\Register;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    public function create() {
        return view(Register::class);
    }
}
