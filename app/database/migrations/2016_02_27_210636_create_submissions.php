<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmissions extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('tfs_ref_submissions', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->integer('item_code')->unique();
            $table->string('type_of_fee');
            $table->decimal('royalty');
            $table->decimal('vat');
            $table->decimal('cess');
            $table->decimal('taff');
            $table->decimal('tree');
            $table->decimal('lmda');
            $table->decimal('lmda_teak');
            $table->integer('f_year');
            $table->timestamps();
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
		//

        Schema::drop('tfs_ref_submissions');
        Schema::drop('tfs_submissions');

	}

}
