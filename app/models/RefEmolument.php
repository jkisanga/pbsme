<?php

class RefEmolument extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		'designation' => 'required',
		'salary_scale' => 'required',
		'code_no' => 'required',
	];
public static $rules1 = [
		'file_name' => 'required',

	];

	// Don't forget to fill this array
	protected $fillable = [];

}