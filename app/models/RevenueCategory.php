<?php

class RevenueCategory extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['id', 'token'];

    protected $table = 'tfs_revenue_categories';

    public function refSubmission(){
        return $this->hasManyThrough('RefSubmission', 'category_id', 'id');
    }

}