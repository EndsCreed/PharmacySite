<?php

use App\Livewire\Pages\Auth\Login;
use App\Livewire\Pages\Auth\Register;
use App\Livewire\Pages\Doctor\Patients;
use App\Livewire\Pages\Doctor\PatientView;
use App\Livewire\Pages\Doctor\ViewPrescription;
use App\Livewire\Pages\Home;
use App\Livewire\Pages\Pharmacy\Contracts;
use App\Livewire\Pages\Pharmacy\ContractView;
use App\Livewire\Pages\Pharmacy\Products;
use App\Livewire\Pages\Pharmacy\ProductView;
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

Route::name('doctor.')->group(function() {
    Route::prefix('doctor/')->group(function() {
        Route::get('home', Home::class)
            ->name('home');

        Route::get('patients', Patients::class)
            ->name('patients');

        Route::get('view-patient/{patient_id}', PatientView::class)
            ->name('patient.view');

        Route::get('view-prescription/{prescription_id}', ViewPrescription::class)
            ->name('prescription.view');
    });
});

Route::name('patient.')->group(function() {
    Route::prefix('patient/')->group(function() {
        Route::get('home', Home::class)
            ->name('home');

        Route::get('information')
            ->name('information');

        Route::get('prescriptions')
            ->name('prescriptions');

        Route::get('view-prescription/{prescription_id}', ViewPrescription::class)
            ->name('prescription.view');
    });
});

Route::name('pharmacy.')->group(function() {
    Route::prefix('pharmacy/')->group(function() {
        Route::get('home', Home::class)
            ->name('home');

        Route::get('contracts', Contracts::class)
            ->name('contracts');

        Route::get('view-contract/{contract_id}', ContractView::class)
            ->name('contract.view');

        Route::get('products', Products::class)
            ->name('products');

        Route::get('view-product/{product_id}', ProductView::class)
            ->name('product.view');
    });
});
