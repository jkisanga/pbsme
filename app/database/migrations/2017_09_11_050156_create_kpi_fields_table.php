<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKpiFieldsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('kpi_fields', function(Blueprint $table)
		{
			//
			$table->increments('id');
			$table->integer('kpi_id')->unsigned()->index();
			$table->integer('field_id')->unsigned()->index();
			$table->timestamps();

		  $table->foreign('kpi_id')->references('id')->on('kpis');
			$table->foreign('field_id')->references('id')->on('ref_kpi_fields');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		 Schema::drop('kpi_fields');
	}

}
