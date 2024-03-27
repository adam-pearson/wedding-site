<?php

namespace App\Guest\Factories;

use App\Guest\Models\Guest;
use Illuminate\Database\Eloquent\Factories\Factory;

class GuestFactory extends Factory
{
    protected $model = Guest::class;

    public function definition()
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'is_child' => fake()->boolean(),
            'plus_one_allowed' => fake()->boolean(),
            'guest_type' => fake()->randomElement(['all_day', 'evening']),
            'unique_code' => strtoupper(bin2hex(random_bytes(3))),
        ];
    }
}