<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRefSubmissionClassesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ref_submission_classes', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('ref_submission_id')->unsigned();
            $table->string('class');
            $table->decimal('rate');
            $table->foreign('ref_submission_id')->references('id')->on('tfs_ref_submissions')->onDelete('cascade');
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
		Schema::drop('ref_submission_classes');
	}

}
