<?php

namespace App\RsvpResponse\Factories;

use App\RsvpResponse\Models\RsvpResponse;
use Illuminate\Database\Eloquent\Factories\Factory;

class RsvpResponseFactory extends Factory
{
    protected $model = RsvpResponse::class;

    public function definition()
    {
        return [
            'coming' => fake()->boolean(),
            'alcohol' => fake()->boolean(),
            'dietary_requirements' => fake()->sentence(),
        ];
    }
}