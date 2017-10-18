<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKpiEvaluationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('kpi_evaluations', function(Blueprint $table)
		{
			//
			$table->increments('id');
			$table->integer('unit_id')->unsigned()->index();
			$table->integer('zone_id')->unsigned()->index();
		  $table->integer('year_id')->unsigned()->index();
			$table->integer('user_id')->unsigned()->index();
			$table->integer('kpi_id')->unsigned()->index();
			$table->timestamps();

		  $table->foreign('year_id')->references('id')->on('financial_years');
			$table->foreign('zone_id')->references('id')->on('tfs_zones');
			$table->foreign('unit_id')->references('id')->on('tfs_units');
			$table->foreign('kpi_id')->references('id')->on('kpis');
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
		   Schema::drop('kpi_evaluations');
	}

}
