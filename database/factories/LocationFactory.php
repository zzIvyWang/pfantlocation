<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->company() . ' Pfand Station',
            'address' => fake()->streetAddress() . ', Berlin',
            'latitude' => fake()->latitude(52.4, 52.6), // 柏林附近的緯度
            'longitude' => fake()->longitude(13.2, 13.6), // 柏林附近的經度
            'description' => fake()->sentence(),
            'user_id' => User::factory(), // 自動關聯一個建立好的 User
        ];
    }
}
