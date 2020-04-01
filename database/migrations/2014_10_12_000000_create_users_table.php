<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });


        DB::table('users')->insert([
            'name' => 'test1',
            'email' => 'test1@test.com',
            'password' => '$2y$10$rtR1wwlwu8W9bZGXjslWSeviSrNoqzq8kNh1OxwIo5ZItPwUZUOv6',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
        DB::table('users')->insert([
            'name' => 'test2',
            'email' => 'test2@test.com',
            'password' => '$2y$10$rtR1wwlwu8W9bZGXjslWSeviSrNoqzq8kNh1OxwIo5ZItPwUZUOv6',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
