<?php

namespace Database\Seeders;

use App\Policies\Shipper;
use Illuminate\Database\Seeder;

class ShipperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Shipper::count() === 0) {

            $shippers = [
                'UPS',
                'FedEx',
                'DHL',
                'TNT',
                'USPS',
            ];

            foreach ($shippers as $shipper) {
                Shipper::create([
                    'name' => $shipper,
                ]);
            }
        }
    }
}
