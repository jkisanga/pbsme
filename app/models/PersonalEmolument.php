<?php

class PersonalEmolument extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		 'designation' => 'required',
		 'salary_scale' => 'required',
		 'established_meaning_level' => 'required|numeric',
		 'actual_strength' => 'required|numeric',
		 'approved_establishment' => 'required|numeric',
		 'approved_estimate' => 'required|numeric',
		 'approved_establishment_next' => 'required|numeric',
		 'approved_estimate_next' => 'required|numeric',
		 'financial_year' => 'required',
	];
    public static $rules1 = [

	];

	// Don't forget to fill this array
	protected $fillable = [];

}