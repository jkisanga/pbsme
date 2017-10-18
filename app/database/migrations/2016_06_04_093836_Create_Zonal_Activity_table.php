<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZonalActivityTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('tfs_zonal_activities', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('zone_id')->unsigned()->index();
            $table->integer('target_id')->unsigned()->index();
            $table->integer('year_id')->unsigned()->index();
            $table->string('number');
            $table->string('description');
            $table->string('type');
            $table->boolean('is_combined')->default(false);
            $table->integer('user_id')->unsigned()->index();
            $table->timestamps();
            $table->foreign('year_id')->references('id')->on('financial_years');
            $table->foreign('zone_id')->references('id')->on('tfs_zones');
            $table->foreign('target_id')->references('id')->on('tfs_targets');
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
