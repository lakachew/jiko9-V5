<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserWorkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_work', function(Blueprint $table)
        {
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned();
            //$table->foreign('users_id')->references('id')->on('users');//have advantage but optional

            $table->integer('work_id')->unsigned();
            //$table->foreign('works_id')->references('id')->on('works');

            $table->integer('work_customer_id')->unsigned();
            //$table->foreign('work_customer_id')->references('customer_id')->on('work');

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
        Schema::drop('user_work');
    }
}
