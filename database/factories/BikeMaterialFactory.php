<?php

namespace Database\Factories;

use App\Models\BikeModel;
use App\Models\BikePart;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BikeMaterial>
 */
class BikeMaterialFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $part = BikePart::inRandomOrder()->first();
        return [
            'bike_part_id'   => $part->id,
            'partial_number' => "m-" . fake()->randomNumber(5, true),
            'price' => fake()->randomFloat(2),
            'warranty_month' => random_int(1, 12),
        ];
    }
}
