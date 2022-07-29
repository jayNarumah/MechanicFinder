<?php

namespace Database\Seeders;

use App\Models\AreaSpecialization;
use App\Models\SpecializationArea;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// use \Illuminate\Database\Seeders\MechanicSeeder;
use App\Models\UserType;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        UserType::create(
            [
                'type' => 'Admin',
            ]
        );
        UserType::create(
            [
                'type' => 'Mechanic',
            ]
        );
        UserType::create(
            [
                'type' => 'Client',
            ]
        );

        $this->call([
            UserSeeder::class,
            CarProductSeeder::class,
            MechanicSeeder::class,
            SpecializationAreaSeeder::class,
            AreaSpecializationSeeder::class,
            RequestSeeder::class,
            FedbackSeeder::class,
            SettingSeeder::class,
        ]);
    }
}
