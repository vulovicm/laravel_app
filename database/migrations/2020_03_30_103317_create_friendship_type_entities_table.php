<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateFriendshipTypeEntitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('friendship_type_entities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });


        DB::table('friendship_type_entities')->insert([
            'name' => 'Requested',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);

        DB::table('friendship_type_entities')->insert([
            'name' => 'Accepted',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);

        DB::table('friendship_type_entities')->insert([
            'name' => 'Canceled',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);

        DB::table('friendship_type_entities')->insert([
            'name' => 'Rejected',
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
        Schema::dropIfExists('friendship_type_entities');
    }
}
