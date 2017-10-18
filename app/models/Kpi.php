<?php

class Kpi extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
	];

	// Don't forget to fill this array
	protected $fillable = ['name','code','strategic_plan','objective_id'];

	public function fields(){
			return $this->hasMany('KpiField');
	}
	
	public function evaluations(){
			return $this->hasMany('KpiEvaluation');
	}
}
