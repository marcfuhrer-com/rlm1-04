<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FloorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('floors')->insert([
            'name' => 'sipbb-s1',
            'building_id' => 1
        ]);

        DB::table('floors')->insert([
            'name' => 'rolex-s1',
            'building_id' => 2
        ]);
    }
}
