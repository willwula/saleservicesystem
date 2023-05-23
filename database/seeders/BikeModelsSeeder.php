<?php

namespace Database\Seeders;

use App\Models\BikeModel;
use Illuminate\Database\Seeder;

class BikeModelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BikeModel::factory()->count(3)->create();
    }
}
