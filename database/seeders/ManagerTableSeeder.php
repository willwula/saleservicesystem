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
        if (Manager::count() === 0) {

            Manager::create([
                'role'     => Manager::ROLE_ADMIN,
                'status'   => Manager::STATUS_ENABLE,
                'name'     => 'admin',
                'email'    => 'admin@gmail.com',
                'password' => \Hash::make('kkkkkk'),
            ]);
            Manager::create([
                'role'     => Manager::ROLE_SERVICECENTER,
                'status'   => Manager::STATUS_ENABLE,
                'name'     => '北區服務中心',
                'email'    => 'sc1@gmail.com',
                'password' => \Hash::make('kkkkkk'),
            ]);
            Manager::create([
                'role'     => Manager::ROLE_SERVICECENTER,
                'status'   => Manager::STATUS_ENABLE,
                'name'     => '中區服務中心',
                'email'    => 'sc2@gmail.com',
                'password' => \Hash::make('kkkkkk'),
            ]);
            Manager::create([
                'role'     => Manager::ROLE_SERVICECENTER,
                'status'   => Manager::STATUS_ENABLE,
                'name'     => '南區服務中心',
                'email'    => 'sc3@gmail.com',
                'password' => \Hash::make('kkkkkk'),
            ]);
        }
    }
}
