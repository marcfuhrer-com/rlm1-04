<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HasRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('has_roles')->insert([
            'role_id' => 3,
            'user_id' => 1
        ]);

        DB::table('has_roles')->insert([
            'role_id' => 3,
            'user_id' => 2
        ]);

        DB::table('has_roles')->insert([
            'role_id' => 3,
            'user_id' => 3
        ]);

        DB::table('has_roles')->insert([
            'role_id' => 2,
            'user_id' => 4
        ]);
    }
}
