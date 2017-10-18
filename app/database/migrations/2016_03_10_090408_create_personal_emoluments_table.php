<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePersonalEmolumentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('personal_emoluments', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('code_no');
            $table->string('designation');
            $table->string('salary_scale');
            $table->integer('established_meaning_level');
            $table->integer('actual_strength');
            $table->integer('approved_establishment');
            $table->bigInteger('approved_estimate');
            $table->bigInteger('approved_establishment_next');
            $table->bigInteger('approved_estimate_next');
            $table->integer('over_under');
            $table->integer('remark_no');
            $table->string('remark');
            $table->date('period');
            $table->integer('financial_year');
            $table->integer('unit_id')->unsigned()->index();
            $table->timestamps();
            $table->foreign('unit_id')->references('id')->on('tfs_units')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('personal_emoluments');
	}

}
