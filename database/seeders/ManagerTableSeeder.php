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
        $manager = new Manager();
        $manager->role = Manager::ROLE_ADMIN;
        $manager->status = Manager::STATUS_ENABLE;
        $manager->name = 'admin';
        $manager->email = 'admin@gmail.com';
        $manager->password = \Hash::make('kkkkkk');
        $manager->save();
    }
}
