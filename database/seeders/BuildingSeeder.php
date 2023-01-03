<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BuildingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('buildings')->insert([
            'name' => 'sipbb'
        ]);

        DB::table('buildings')->insert([
            'name' => 'rolex'
        ]);
    }
}
