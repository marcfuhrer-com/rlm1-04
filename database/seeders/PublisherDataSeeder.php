<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PublisherDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('publisher_data')->insert([
            'name' => 'room-management',
            'building_id' => 1,
            'floor_id' => 1
        ]);

        DB::table('publisher_data')->insert([
            'name' => 'mensa-rolex',
            'building_id' => 2,
            'floor_id' => 2
        ]);

        DB::table('publisher_data')->insert([
            'name' => 'indoor-localization',
            'building_id' => 1,
            'floor_id' => 1
        ]);
    }
}
