<?php

class Projection extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		 'file_name' => 'required'
	];

    protected $table = 'tfs_projections';

	// Don't forget to fill this array
	protected $fillable = ['id', 'token'];


    public function user(){
        return $this->belongsTo('User', 'created_by', 'id');
    }

    public function refProjection(){
        return $this->belongsTo('RefProjection', 'ref_projection_id', 'id');

    }
}