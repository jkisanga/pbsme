<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTfsRefItem extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//

        Schema::create('tfs_ref_items', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('input_description');
            $table->string('item_code');
            $table->boolean('delete')->default(false);
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
