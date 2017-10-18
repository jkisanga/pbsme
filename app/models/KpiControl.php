<?php

class KpiControl extends Eloquent{

    protected $table = 'kpi_control';

    public function financial_year(){
        return $this->belongsTo('FinancialYear', 'year_id', 'id');
    }
    public function unit(){
        return $this->belongsTo('Unit', 'unit_id', 'id');
    }
    public function user(){
        return $this->belongsTo('Users', 'user_id', 'id');
    }

    public function is_submitted($year_id,$unit_id,$quarter){
        $result =  $this->where('year_id','=',$year_id)
				->where('quarter','=',$quarter)
				->where('unit_id','=',$unit_id)->first();
        if(isset($result)){
            return true;
        }else{
            return false;
        }
    }
	
	  public function submitted_report($year_id,$unit_id){
        return $this->where('year_id','=',$year_id)->where('unit_id','=',$unit_id)->get();
		       
    }
	 public function submitted_quarters($year_id,$unit_id){
        $result = $this->where('year_id','=',$year_id)->where('unit_id','=',$unit_id)->get();
		$quarters = [];
		for($r = 0; $r < count($result); $r++){
			$quarters[] = $result[$r]->quarter;
		}
		
		return 	$quarters;	
    }

    public  static function submitted_budget_global($zone_id){
        return DB::table('tfs_unit_control')
            ->join('financial_years','financial_years.id','=','tfs_unit_control.year_id')
            ->join('tfs_units','tfs_units.id','=','tfs_unit_control.unit_id')
            ->join('tfs_zones','tfs_zones.id','=','tfs_units.zone_id')
            ->join('users','users.id','=','tfs_unit_control.user_id')
            ->select('users.*','tfs_unit_control.id as id','financial_years.year as year','tfs_units.name as unit','tfs_units.id as unit_id')
            ->where('financial_years.status','=',1)
            ->where('tfs_zones.id','=',$zone_id)
            ->get();

    }

    public function submitted_budget($zone_id){
        return DB::table('kpi_control')
            ->join('financial_years','financial_years.id','=','tfs_unit_control.year_id')
            ->join('tfs_units','tfs_units.id','=','tfs_unit_control.unit_id')
            ->join('tfs_zones','tfs_zones.id','=','tfs_units.zone_id')
            ->join('users','users.id','=','tfs_unit_control.user_id')
            ->select('users.*','tfs_unit_control.id as id','financial_years.year as year','tfs_units.name as unit','tfs_units.id as unit_id')
            ->where('financial_years.status','=',1)
            ->where('tfs_zones.id','=',$zone_id)
            ->get();
    }

    public function zoneUnitsSubmitted($zone_id,$year_id){
        return DB::table('tfs_units')
            ->join('kpi_control','kpi_control.unit_id','=','tfs_units.id')
			->join('users','users.id','=','kpi_control.user_id')
			->select('tfs_units.*','kpi_control.id as kid','kpi_control.quarter as quarter','users.first_name as first_name','users.last_name as last_name')
            ->where('tfs_units.zone_id','=',$zone_id)
            ->where('tfs_units.deleted','=',0)            
            ->where('kpi_control.year_id','=',$year_id)            
            ->get();
    }
}