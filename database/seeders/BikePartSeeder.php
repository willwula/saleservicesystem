<?php

namespace Database\Seeders;

use App\Models\BikePart;
use Illuminate\Database\Seeder;

class BikePartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (BikePart::count() === 0) {

            $bikeParts = [
                'Handlebars',
                'Seat',
                'Pedals',
                'Chain',
                'Tires',
                'Brakes',
                'Frame',
                'Fork',
                'Crankset',
                'Derailleur',
            ];
            foreach ($bikeParts as $bikePart) {
                BikePart::create([
                    'name' => $bikePart,
                ]);
            }
        }
    }
}
