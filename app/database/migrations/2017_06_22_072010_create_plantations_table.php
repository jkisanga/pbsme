<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlantationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('plantations', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('zone_id')->unsigned();
            $table->string('name');
            $table->string('estimated_area');
            $table->foreign('zone_id')->references('id')->on('tfs_zones');
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
		Schema::drop('plantations');
	}

}
