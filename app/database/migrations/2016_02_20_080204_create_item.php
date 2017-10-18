<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItem extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('tfs_items', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('input_description');
            $table->string('item_code');
            $table->string('unit_of_measure');
            $table->decimal('unit_cost',16);
            $table->integer('no_of_unit');
			$table->decimal('total_unit');
			$table->decimal('number_of_input');
            $table->double('cost',16);
            $table->boolean('delete')->default(false);
            $table->integer('activity_id')->unsigned()->index();
            $table->timestamps();

            $table->foreign('activity_id')->references('id')->on('tfs_activities')->onDelete('cascade');
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
