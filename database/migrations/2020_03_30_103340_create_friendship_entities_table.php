<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFriendshipEntitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('friendship_entities', function (Blueprint $table) {
            $table->id();
            $table->integer('requester_id');
            $table->integer('addresse_id');
            $table->timestamps();

            $table->bigInteger('friendship_type_id')->unsigned();
            $table->foreign('friendship_type_id')->references('id')->on('friendship_type_entities')
            ->onDelete('cascade')->onUpdate('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('friendship_entities');
    }
}
