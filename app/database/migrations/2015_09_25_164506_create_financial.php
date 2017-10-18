<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinancial extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('financial_years', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('year');
            $table->decimal('projection_percentage')->default(false);
            $table->boolean('locked')->default(false);
            $table->boolean('status')->default(false);
            $table->boolean('delete')->default(false);
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
		//
	}

}
