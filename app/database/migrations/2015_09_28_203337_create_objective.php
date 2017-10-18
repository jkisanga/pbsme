<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObjective extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('tfs_objectives', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('ob_description');
            $table->string('ob_code');
            $table->boolean('delete')->default(false);
            $table->double('rand_no');
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
