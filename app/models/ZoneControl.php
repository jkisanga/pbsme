<?php

class ZoneControl extends Eloquent{

    protected $table = 'tfs_zone_control';

    public function financial_year(){
        return $this->belongsTo('FinancialYear', 'year_id', 'id');
    }
    public function zone(){
        return $this->belongsTo('Zone', 'zone_id', 'id');
    }
    public function user(){
        return $this->belongsTo('Users', 'user_id', 'id');
    }

    public static function is_submitted($year_id,$zone_id){
        $result =  ZoneControl::where('year_id','=',$year_id)->where('zone_id','=',$zone_id)->first();
        if(isset($result)){
            return true;
        }else{
            return false;
        }
    }
	

    public static function submitted_zone_budget_global(){
        return DB::table('tfs_zone_control')
            ->join('financial_years','financial_years.id','=','tfs_zone_control.year_id')
            ->join('tfs_zones','tfs_zones.id','=','tfs_zone_control.zone_id')
            ->join('users','users.id','=','tfs_zone_control.user_id')
            ->select('users.*','tfs_zone_control.id as id','financial_years.year as year','tfs_zones.zone_name as zone','tfs_zones.id as zone_id')
            ->where('financial_years.status','=',1)
            ->get();
    }
	
	

    public function submitted_zone_budget(){
        return DB::table('tfs_zone_control')
            ->join('financial_years','financial_years.id','=','tfs_zone_control.year_id')
            ->join('tfs_zones','tfs_zones.id','=','tfs_zone_control.zone_id')
            ->join('users','users.id','=','tfs_zone_control.user_id')
            ->select('users.*','tfs_zone_control.id as id','financial_years.year as year','tfs_zones.zone_name as zone','tfs_zones.id as zone_id')
            ->where('financial_years.status','=',1)
            ->get();
    }
	
	
	
    public function is_consolidation_complete($year_id,$zone_id){
    	$activities = DB::table('tfs_activities')
	            ->join('tfs_units','tfs_units.id','=','tfs_activities.unit_id')
	            ->join('tfs_targets','tfs_targets.id','=','tfs_activities.target_id')
	            ->select('tfs_targets.*')
	            ->where('tfs_units.deleted','=',0)
		    ->where('tfs_activities.zone_id','=',$zone_id)         
		    ->where('tfs_activities.year_id','=',$year_id)
	            ->where('tfs_activities.is_combined','=',false)
				->orderBy('activity_no')
	            ->get();
    }
  
}