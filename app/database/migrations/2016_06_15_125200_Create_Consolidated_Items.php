<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsolidatedItems extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('tfs_consolidated_items', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('item_id')->unsigned()->index();
            $table->integer('consolidated_activity_id')->unsigned()->index();
            $table->integer('unit_id')->unsigned()->index();
            $table->timestamps();
            $table->foreign('item_id')->references('id')->on('tfs_items');
            $table->foreign('consolidated_activity_id')->references('id')->on('tfs_consolidated_activities');
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
