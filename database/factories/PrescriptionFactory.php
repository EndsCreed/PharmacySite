<?php

namespace Database\Factories;

use App\Models\Prescription;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrescriptionFactory extends Factory
{
    protected $model = Prescription::class;

    public function definition(): array
    {
        return [
            'doctor' => fake()->unique()->randomNumber(9),
            'drug' => fake()->randomNumber(2),
            'patient' => fake()->unique()->randomNumber(9),
            'created_at' => now(),
            'quantity' => fake()->randomNumber(2)
        ];
    }
}
