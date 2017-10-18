<?php

class HIVInfection extends \Eloquent {

    protected $table = 'HIV_Infections';

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['kpi_id','unit_id','user_id','financial_id','age_group','no_male','no_female',
    'no_male_hiv','no_female_hiv','quarter','remark'];

}