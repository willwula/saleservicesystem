<?php

namespace Database\Seeders;

use App\Models\BikeMaterial;
use Illuminate\Database\Seeder;

class BikeMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BikeMaterial::factory()->count(5)->create();
    }
}
