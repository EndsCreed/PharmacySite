<?php

use App\Livewire\Actions\Logout;
use App\Livewire\Components\CreatePatient;
use App\Livewire\Pages\Auth\Login;
use App\Livewire\Pages\Auth\Register;
use App\Livewire\Pages\Doctor\CreatePrescription;
use App\Livewire\Pages\Doctor\Patients;
use App\Livewire\Pages\Doctor\PatientView;
use App\Livewire\Pages\Doctor\ViewPrescription;
use App\Livewire\Pages\Home;
use Illuminate\Support\Facades\Route;

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


Route::middleware('auth:doctor')->group( function() {

    Route::get('home', Home::class)
        ->name('home');

    Route::get('patients', Patients::class)
        ->name('patients');

    Route::get('create-patient', CreatePatient::class)
        ->name('patient.create');

    Route::get('view-patient/{patient_id}', PatientView::class)
        ->name('patient.view');

    Route::get('create-prescription/{patient_id}', CreatePrescription::class)
        ->name('prescription.create');

    Route::get('view-prescription/{prescription_id}', ViewPrescription::class)
        ->name('prescription.view');
});

//Route::middleware('can:view-home')->group(function () {
//    Route::get('home', Home::class)
//        ->name('home');
//});
//
//Route::middleware('can:access-doctor')->group(function () {
//    include base_path('routes/doctor.php');
//});
