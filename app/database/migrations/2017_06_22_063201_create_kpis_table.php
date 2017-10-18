<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateKpisTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('kpis', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('code');
            $table->string('name');
            $table->integer('objective_id')->unsigned();
            $table->string('strategic_plan');
            $table->foreign('objective_id')->references('id')->on('tfs_objectives');
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
		Schema::drop('kpis');
	}

}
