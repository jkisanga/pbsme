<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZonalItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        //
        Schema::create('tfs_zonal_items', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('item_id')->unsigned()->index();
            $table->integer('activity_id')->unsigned()->index();
            $table->integer('zonal_activity_id')->unsigned()->index();
            $table->integer('unit_id')->unsigned()->index();
            $table->timestamps();
            $table->foreign('item_id')->references('id')->on('tfs_items');
            $table->foreign('activity_id')->references('id')->on('tfs_activities');
            $table->foreign('zonal_activity_id')->references('id')->on('tfs_zonal_activities');
            $table->foreign('unit_id')->references('id')->on('tfs_units');
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
