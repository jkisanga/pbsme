<?php

class RefKpiField extends \Eloquent {

	// Add your validation rules here
	public static $rules = [

		 'name' => 'required',
		 'label' => 'required',
		 'data_type' => 'required',
	];

	// Don't forget to fill this array
	protected $fillable = ['name','label','data_type','validation_rule','options'];

}
