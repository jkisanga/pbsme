<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTfsUnitsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        //
        Schema::create('tfs_units', function($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('zone_id')->unsigned()->index();
            $table->string('name');
            $table->string('description');
            $table->integer('deleted')->unsined();
            $table->timestamps();
            $table->foreign('zone_id')->references('id')->on('tfs_zones')->onDelete('cascade');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tfs_units');
	}

}
