<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTfsTarget extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('tfs_targets', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('ta_description');
            $table->string('target_no');
            $table->string('target_type');
            $table->integer('vote')->unsigned()->index();
            $table->integer('objective_id')->unsigned()->index();
            $table->boolean('delete')->default(false);
            $table->timestamps();

            $table->foreign('objective_id')->references('id')->on('tfs_objectives')->onDelete('cascade');

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
