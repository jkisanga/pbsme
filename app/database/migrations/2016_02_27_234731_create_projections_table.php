<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProjectionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('tfs_ref_projections', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->integer('item_code');
            $table->string('type_of_fee');
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('tfs_revenue_categories')->onDelete('cascade');
        });

		Schema::create('tfs_projections', function(Blueprint $table)
		{
            $table->increments('id');
            $table->integer('unit_id')->unsigned();
            $table->integer('ref_projection_id')->unsigned();
            $table->string('financial_year');
            $table->decimal('actual', 16, 2);
            $table->decimal('current_year', 16, 2);
            $table->decimal('projected_year', 16, 2);
            $table->integer('created_by')->unsgned();
            $table->foreign('ref_projection_id')->references('id')->on('tfs_ref_projections')->onDelete('cascade');
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
		Schema::drop('tfs_projections');
        Schema::drop('tfs_ref_projections');
	}

}
