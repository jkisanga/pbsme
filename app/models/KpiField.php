<?php

class KpiField extends \Eloquent {


	// Don't forget to fill this array
	protected $fillable = ['kpi_id','field_id'];

	public static function is_exist($kpi_id,$field_id){
		$field = KpiField::where('kpi_id','=',$kpi_id)
					->where('field_id','=',$field_id)
					->first();
				if(count($field) > 0){
					return true;
				}else{
					return false;
				}
	}
	public function field(){
			return $this->belongsTo('RefKpiField');
	}
}
