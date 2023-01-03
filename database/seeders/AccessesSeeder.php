<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccessesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accesses')->insert([
            'user_id' => '1',
            'publisher_data_id' => 1,
            'creates' => false,
            'reads' => false,
            'updates' => true,
            'deletes' => false,
            'subscribes' => false
        ]);

        DB::table('accesses')->insert([
            'user_id' => '2',
            'publisher_data_id' => 1,
            'creates' => false,
            'reads' => false,
            'updates' => true,
            'deletes' => false,
            'subscribes' => false
        ]);

        DB::table('accesses')->insert([
            'user_id' => '3',
            'publisher_data_id' => 1,
            'creates' => false,
            'reads' => false,
            'updates' => true,
            'deletes' => false,
            'subscribes' => false
        ]);
    }
}
