<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefKpiFieldsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ref_kpi_fields', function(Blueprint $table)
		{
			//
			$table->increments('id');
			$table->string('name');
			$table->string('label');
			$table->string('data_type');
			$table->string('validation_rule');
			$table->string('options');
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
      Schema::drop('ref_kpi_fields');
	}

}
