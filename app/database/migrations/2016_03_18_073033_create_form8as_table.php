<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateForm8asTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('form8as', function(Blueprint $table)
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
            $table->string('over_under');
            $table->string('remark');
            $table->date('period');
            $table->string('financial_yer');
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
		Schema::drop('form8as');
	}

}
