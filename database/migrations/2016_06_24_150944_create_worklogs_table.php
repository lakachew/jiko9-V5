<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorklogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('worklogs', function(Blueprint $table)
        {
            $table->increments('id')->unsigned();

            $table->integer('user_work_id')->unsigned();
            //$table->foreign('user_work_id')->references('id')->on('user_work');

            $table->text('description')->nullable();

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
        Schema::drop('worklogs');
    }
}
