<?php

class RefSubmission extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		'file_name' => 'required'
	];
    protected $table = 'tfs_ref_submissions';

	// Don't forget to fill this array
	protected $fillable = ['id', 'token'];

    public function category(){
        return $this->belongsTo('RevenueCategory', 'category_id', 'id');
    }

    public function classes(){
        return $this->hasMany('RefSubmissionClass');
    }

}