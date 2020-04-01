<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            'name' => 'test1',
            'email' => 'test1@test.com',
            'password' => '$2y$10$rtR1wwlwu8W9bZGXjslWSeviSrNoqzq8kNh1OxwIo5ZItPwUZUOv6',
        ]);
        DB::table('users')->insert([
            'name' => 'test2',
            'email' => 'test2@test.com',
            'password' => '$2y$10$rtR1wwlwu8W9bZGXjslWSeviSrNoqzq8kNh1OxwIo5ZItPwUZUOv6',
        ]);

    }
}
