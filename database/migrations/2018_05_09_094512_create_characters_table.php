<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_rand');
            $table->integer('uid')->unsigned()->nullable();
            $table->string('player_name')->nullable();
            $table->string('actor_name')->nullable();
            $table->string('organization')->nullable();
            $table->string('age')->nullable();
            $table->string('gender')->nullable();
            $table->string('photo')->nullable();
            $table->string('good')->nullable();
            $table->string('evil')->nullable();
            $table->string('social')->nullable();
            $table->string('most_important')->nullable();
            $table->integer('omote1_id')->unsigned()->nullable();
            $table->string('omote1_free')->nullable();
            $table->integer('omote2_id')->unsigned()->nullable();
            $table->string('omote2_free')->nullable();
            $table->integer('omote3_id')->unsigned()->nullable();
            $table->string('omote3_free')->nullable();
            $table->integer('ura1_id')->unsigned()->nullable();
            $table->string('ura1_free')->nullable();
            $table->integer('ura2_id')->unsigned()->nullable();
            $table->string('ura2_free')->nullable();
            $table->integer('ura3_id')->unsigned()->nullable();
            $table->string('ura3_free')->nullable();
            $table->integer('ura4_id')->unsigned()->nullable();
            $table->string('ura4_free')->nullable();
            $table->integer('ura5_id')->unsigned()->nullable();
            $table->string('ura5_free')->nullable();
            $table->string('kill1')->nullable();
            $table->string('kill2')->nullable();
            $table->string('kill3')->nullable();
            $table->string('kill4')->nullable();
            $table->string('kill5')->nullable();
            $table->text('memo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('characters');
    }
}
