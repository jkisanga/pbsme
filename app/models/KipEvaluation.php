<?php

class KpiEvaluation extends \Eloquent {


protected $guarded  = array('id','_token');


public static function getPossibleEnumValues($name){

    $enumStr = DB::select( DB::raw('SHOW COLUMNS FROM kpi_evaluations WHERE Field = "'.$name.'"'))[0]->Type;
	preg_match('/^enum\((.*)\)$/', $enumStr, $matches);
	   foreach( explode(',', $matches[1]) as $value )
	   {
		   $enum[] = trim( $value, "'" );   
	   }

   return $enum;

}

public static function getKpiEvaluation($kpi_id,$unit_id,$year_id){
	
	return KpiEvaluation::where("kpi_id","=",$kpi_id)
						->where("unit_id","=",$unit_id)
						->where("year_id","=",$year_id)
						;
}


public static function getZoneKpiEvaluation($kpi_id,$zone_id,$year_id){
	
	return KpiEvaluation::where("kpi_id","=",$kpi_id)
						->where("zone_id","=",$zone_id)
						->where("year_id","=",$year_id)
						;
}

public static function getOverallKpiEvaluation($kpi_id,$year_id){
	
	return KpiEvaluation::where("kpi_id","=",$kpi_id)
						->where("year_id","=",$year_id)
						;
}
}
