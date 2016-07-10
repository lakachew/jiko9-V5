<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function(Blueprint $table)
        {
            $table->increments('id')->unsigned();
            $table->string('company_name', 50)->default('private');
            $table->string('contact_name', 50);
            $table->string('email', 50)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('address', 200)->nullable();
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
        Schema::drop('customers');
    }
}
