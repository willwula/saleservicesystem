<?php

namespace Database\Seeders;

use App\Models\Manager;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ManagerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Manager::create([
            'role'=> Manager::ROLE_ADMIN,
            'status'=> Manager::STATUS_ENABLE,
            'name'=> 'admin',
            'email'=> 'admin@gmail.com',
            'password'=> \Hash::make('kkkkkk'),
        ]);
    }
}
