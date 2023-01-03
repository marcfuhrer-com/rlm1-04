<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'rlm1-01',
            'email' => 'florian.moser@students.bfh.ch',
            'password' => Hash::make('r74WGFt9SNj4xAVG54DC'),
        ]);

        DB::table('users')->insert([
            'name' => 'rlm1-02',
            'email' => 'yannik.daellenbach@students.bfh.ch',
            'password' => Hash::make('7EZKEpHyPk31tci43eSQ'),
        ]);

        DB::table('users')->insert([
            'name' => 'rlm1-05',
            'email' => 'nicole.zingg@students.bfh.ch',
            'password' => Hash::make('SebI93ZrMunUwat4aeoU'),
        ]);
    }
}
