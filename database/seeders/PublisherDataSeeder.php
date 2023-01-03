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
            'name' => 'gruppenraum1',
            'building_id' => 1,
            'floor_id' => 1
        ]);
    }
}
