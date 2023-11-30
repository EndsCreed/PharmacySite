<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\QueryException;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Facades\Log;
use App\Models\{User, Doctor, Drug, Prescription, Pharmacy, Patient, Company, Contract};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    private static ?string $password;

    /**
     * Seed the application's database.
     */
    public function run(): void {
        // User Factory
        User::factory(1)->create();

        // Doctor Factory and example doctor for testing
        Doctor::factory(4)->create();
        Doctor::factory(1)->create([
            'sin' => '123456789'
        ]);

        // Patient Factory
        Patient::factory(20)->create();

        // Company Factory
        Company::factory(20)->create();

        // Pharmacy Factory
        Pharmacy::factory(20)->create();

        // Drug Factory
        Drug::factory(60)->create();


        // Contract seeds
        Company::all()->each(function($company) {
            $pharmacies = Pharmacy::all()->pluck('id');
            retry:
            try {
                Contract::factory(rand(1, 5))->create([
                    'company' => $company->name,
                    'pharmacy' => array_rand($pharmacies->all())
                ]);
            } catch (UniqueConstraintViolationException|QueryException) {
                return;
            }
        });

        // Prescription seeds
        Doctor::all()->each(function($doctor, $sin) {
            $patientSins = Patient::all()->pluck('sin');
            $drugIds = Drug::all()->pluck('id');
            retry:
            try {
                Prescription::factory(rand(0,4))->create([
                    'doctor' => $sin,
                    'patient' => array_rand($patientSins->all()),
                    'drug' => array_rand($drugIds->all()),
                ])->unique;
            } catch (UniqueConstraintViolationException|QueryException $e) {
                return;
            }
        });
    }
}
