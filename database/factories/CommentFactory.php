<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'content' => fake()->paragraph(),
            'rating' => fake()->numberBetween(1, 5),
            'user_id' => User::factory(),
            'location_id' => Location::factory(),
        ];
    }
}
