<?php

use App\Livewire\Components\CreatePatient;
use App\Livewire\Pages\Doctor\CreatePrescription;
use App\Livewire\Pages\Doctor\Patients;
use App\Livewire\Pages\Doctor\PatientView;
use App\Livewire\Pages\Doctor\ViewPrescription;
use App\Livewire\Pages\Home;
use Illuminate\Support\Facades\Route;

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
