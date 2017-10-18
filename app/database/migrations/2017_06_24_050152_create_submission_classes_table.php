<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubmissionClassesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('submission_classes', function(Blueprint $table)
		{
            $table->increments('id');
            $table->integer('unit_id')->unsigned()->index();
            $table->integer('zone_id')->unsigned()->index();
            $table->integer('financial_year');
            $table->integer('submission_id')->unsigned()->index();
            $table->string('class');
            $table->decimal('rate');
            $table->decimal('volume', 16,2);
            $table->decimal('grand_royalty', 18,2);
            $table->decimal('taff', 18,2);
            $table->decimal('royalty', 18,2);
            $table->foreign('submission_id')->references('id')->on('tfs_submissions')->onDelete('cascade');
            $table->foreign('zone_id')->references('id')->on('tfs_zones')->onDelete('cascade');
            $table->foreign('unit_id')->references('id')->on('tfs_units')->onDelete('cascade');
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
		Schema::drop('submission_classes');
	}

}
