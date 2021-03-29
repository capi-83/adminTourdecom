<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommanderMixesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commander_mixes', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->text('commander');
            $table->text('decklist');
            $table->enum('color', array('w', 'u', 'b', 'r', 'g'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commander_mixes');
    }
}
