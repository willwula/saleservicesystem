<?php

namespace Database\Factories;

use App\Models\BikeBrand;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BikeModel>
 */
class bikeModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $brand = BikeBrand::find(rand(1,6));
        return [
            'bike_brand_id' => $brand->id,
            'name' => $brand->name . "-" .fake()->word,
        ];
    }
}
