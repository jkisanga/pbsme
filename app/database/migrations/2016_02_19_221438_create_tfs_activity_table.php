<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTfsActivityTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */

	public function up()
	{
        Schema::create('tfs_activities', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('zone_id')->unsigned()->index();
            $table->integer('unit_id')->unsigned()->index();
            $table->integer('target_id')->unsigned()->index();
            $table->integer('year_id')->unsigned()->index();
            $table->string('activity_no');
            $table->string('a_description');
            $table->boolean('is_combined')->default(false);
            $table->string('type');
            $table->timestamps();
            $table->foreign('year_id')->references('id')->on('financial_years');
            $table->foreign('zone_id')->references('id')->on('tfs_zones');
            $table->foreign('unit_id')->references('id')->on('tfs_units');
            $table->foreign('target_id')->references('id')->on('tfs_targets');
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
