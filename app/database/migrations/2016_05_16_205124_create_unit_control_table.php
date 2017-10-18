<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitControlTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		  Schema::create('tfs_unit_control', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('year_id')->unsigned()->index();
            $table->integer('unit_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            $table->timestamps();

            $table->foreign('year_id')->references('id')->on('financial_years');
            $table->foreign('unit_id')->references('id')->on('tfs_units');
            $table->foreign('user_id')->references('id')->on('users');
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
