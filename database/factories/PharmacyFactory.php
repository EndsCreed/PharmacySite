<?php

namespace Database\Factories;

use App\Models\Drug;
use App\Models\Pharmacy;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PharmacyFactory extends Factory
{
    private static ?string $password;
    protected $model = Pharmacy::class;

    public function definition(): array {
        return [
            'address' => fake()->unique()->address,
            'name' => fake()->name,
            'password' => static::$password ??= Hash::make('password'),
            'phone' => fake()->e164PhoneNumber
        ];
    }
}
