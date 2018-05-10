<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ore_id');
            $table->string('text1');
            $table->string('text2')->nullable();
            $table->tinyInteger('good')->default(0);
            $table->tinyInteger('evil')->default(0);
            $table->tinyInteger('social')->default(0);
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
        Schema::dropIfExists('ores');
    }
}
