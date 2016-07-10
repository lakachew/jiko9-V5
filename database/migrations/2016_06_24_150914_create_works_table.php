<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('works', function(Blueprint $table)
        {
            $table->increments('id')->unsigned();

            $table->integer('customer_id')->unsigned();
            //$table->foreign('customer_id')->references('id')->on('customers');

            $table->string('address', 500);
            $table->double('longitude');
            $table->double('latitude');
            $table->text('description')->nullable();
            $table->boolean('finished')->default(false);
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
        Schema::drop('works');
    }
}
