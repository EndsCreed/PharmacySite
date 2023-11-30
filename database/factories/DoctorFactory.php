<?php

namespace Database\Factories;

use App\Models\Doctor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class DoctorFactory extends Factory
{
    protected $model = Doctor::class;
    protected static ?string $password;

    public function definition(): array
    {
        return [
            'sin' => fake()->randomNumber(9),
            'name' => fake()->name,
            'specialty' => fake()->word(),
            'experience' => rand(1, 25),
            'password' => static::$password ??= Hash::make('password'),
        ];
    }
}
