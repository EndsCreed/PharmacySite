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
        $drugIds = Drug::all()->pluck('id');
        foreach (Doctor::all() as $doctor) {
            $sin = $doctor->sin;
            $patients = Patient::all()->shuffle()->all();
            for ($i = random_int(0,4); $i > 0; $i--) {
                $patientSin = array_pop($patients)->sin;
                Prescription::factory(1)->create([
                    'doctor' => $sin,
                    'patient' => $patientSin,
                    'drug' => array_rand($drugIds->all()),
                ])->unique;
            }
        }

        // Company Creates

        $d = 0;
        foreach (Company::all() as $c) {
            $i = 0;
            while ($i < 4 && $d < 60) {
                $d++;
                DB::table('company_creates')->insert([
                    'company' => $c->name,
                    'drug' => $d
                ]);
                $i++;
            }
        }

//        Doctor::all()->each(function($doctor, $sin) {
//
//        });
    }
}
