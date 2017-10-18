<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZonesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('tfs_zones', function($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('zone_name');
            $table->string('short_name');
            $table->integer('created_by')->unsined();
            $table->integer('deleted')->unsined();
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
		//
	}

}
