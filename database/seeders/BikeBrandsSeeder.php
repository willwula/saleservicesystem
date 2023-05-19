<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BikeBrandsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bike_brands')->insert([
            'name' => 'Giant',
            'description' => '臺灣創立的世界級自行車製造商',
        ]);
        DB::table('bike_brands')->insert([
            'name' => 'Merida',
            'description' => '台灣起源的世界知名自行車品牌',
        ]);
        DB::table('bike_brands')->insert([
            'name' => 'Trek',
            'description' => '創新技術和卓越設計的自行車領導品牌',
        ]);
        DB::table('bike_brands')->insert([
            'name' => 'Specialized',
            'description' => '為騎行者提供定制化體驗的自行車專家',
        ]);
        DB::table('bike_brands')->insert([
            'name' => 'Cannondale',
            'description' => '注重性能與創新的高品質自行車製造商',
        ]);
        DB::table('bike_brands')->insert([
            'name' => 'Bianchi',
            'description' => '擁有悠久歷史的義大利經典自行車品牌',
        ]);

    }
}
