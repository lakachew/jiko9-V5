<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maps', function(Blueprint $table)
        {
            $table->increments('id')->unsigned();

            $table->integer('worklog_id')->unsigned();
            //$table->foreign('worklogs_id')->references('id')->on('worklogs');

            $table->double('longitude');
            $table->double('latitude');
            $table->boolean('start');
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
        Schema::drop('maps');
    }
}
