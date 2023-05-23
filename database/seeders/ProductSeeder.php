<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Product $product)
    {
        $number = optional($product->latest('id')->first())->id + 1;
        $numberOfDigits = 6;
        $formattedDate = Carbon::now()->format('ymd');
        $registedDate = Carbon::now()->format('Y-m-d'); 
        DB::table('products')->insert([
            'customer_id' => fake()->numberBetween(1, 3),
            'product_number' => $formattedDate . str_pad($number, $numberOfDigits, '0', STR_PAD_LEFT),
            'serial_number' => fake()->numberBetween(1, 5),
            'bike_brand_name' => fake()->randomElement(['Giant', 'Merida', 'Trek', 'Specialized', 'Cannondale', 'Bianchi']),
            'registed_date' => $registedDate,
            'bike_model_name' => fake()->randomElement(['Off-Road', 'Enduro']),
            'mortor_barcode' => Str::random(6),
            'created_at' => now(),
        ]);
    }
}
