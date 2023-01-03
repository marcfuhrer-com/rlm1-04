<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            BuildingSeeder::class,
            FloorSeeder::class,
            PublisherDataSeeder::class,
            AccessesSeeder::class
        ]);
    }
}
