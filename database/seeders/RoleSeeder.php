<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'Service',
        ]);

        DB::table('roles')->insert([
            'name' => 'Service Administrator',
        ]);

        DB::table('roles')->insert([
            'name' => 'Publisher',
        ]);

        DB::table('roles')->insert([
            'name' => 'Subscriber',
        ]);

        DB::table('roles')->insert([
            'name' => 'User',
        ]);

    }
}
