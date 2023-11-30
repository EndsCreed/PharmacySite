<?php

use App\Livewire\Actions\Logout;
use App\Livewire\Pages\Doctor\CreatePatient;
use App\Livewire\Pages\Doctor\Patients;
use App\Livewire\Pages\Doctor\PatientView;
use App\Livewire\Pages\Home;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Livewire\Pages\Auth\Register;
use App\Livewire\Pages\Auth\Login;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware('guest')->group(function () {
    Route::get('register', Register::class)
        ->name('register');

    Route::get('login', Login::class)
        ->middleware('web')
        ->name('login');
});

Route::middleware('auth:doctor')->group(function () {
    Route::get('home', Home::class)
        ->name('home');

    Route::get('patients', Patients::class)
        ->name('patients');

    Route::get('create-patient', CreatePatient::class)
        ->name('patient.create');

    Route::get('view-patient', PatientView::class)
        ->name('patient.view');
});
