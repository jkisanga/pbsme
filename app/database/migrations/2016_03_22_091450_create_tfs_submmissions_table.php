<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTfsSubmmissionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tfs_submissions', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('officer_id');
            $table->integer('unit_id')->unsigned()->index();
            $table->integer('zone_id')->unsigned()->index();
            $table->integer('category_id')->unsigned()->index();
            $table->integer('item_code');
            $table->string('type_of_fee');
            $table->decimal('percent_royalty');
            $table->decimal('percent_vat');
            $table->decimal('percent_cess');
            $table->decimal('percent_taff');
            $table->decimal('percent_tree');
            $table->decimal('percent_lmda');
            $table->decimal('percent_lmda_teak');
            $table->integer('financial_year');
            $table->bigInteger('unit_price');
            $table->integer('quantity');
            $table->bigInteger('total_revenue');
            $table->bigInteger('quarter_1');
            $table->bigInteger('quarter_2');
            $table->bigInteger('quarter_3');
            $table->bigInteger('quarter_4');
            $table->decimal('royalty',17,2);
            $table->decimal('vat',16,2);
            $table->decimal('cess',16,2);
            $table->decimal('taff',16,2);
            $table->decimal('lmda',16,2);
            $table->decimal('tree',16,2);
            $table->string('status');
			$table->timestamps();
            $table->foreign('zone_id')->references('id')->on('tfs_zones')->onDelete('cascade');
            $table->foreign('unit_id')->references('id')->on('tfs_units')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('tfs_revenue_categories')->onDelete('cascade');

        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tfs_submmissions');
	}

}
