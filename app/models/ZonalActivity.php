<?php

class ZonalActivity extends  Eloquent{

    protected $table = 'tfs_zonal_activities';

  //STATIC FUNCTIONS

    public static function getActivitiesByZone($zone_id,$target_id,$year_id){
        return DB::table('tfs_zonal_activities')
            ->where('tfs_zonal_activities.zone_id','=',$zone_id)
            ->where('tfs_zonal_activities.target_id','=',$target_id)
            ->where('tfs_zonal_activities.year_id','=',$year_id)
            ->orderBy('number')
            ->get();
    } 

	public static function totalActivitiesPerObjective($zone_id,$objective_id,$year_id){
        return DB::table('tfs_zonal_activities')
		  ->join('tfs_targets','tfs_targets.id','=','tfs_zonal_activities.target_id')
		   ->where('tfs_targets.objective_id','=',$objective_id)
            ->where('tfs_zonal_activities.zone_id','=',$zone_id)         
            ->where('tfs_zonal_activities.year_id','=',$year_id)
            ->orderBy('number')
            ->get();
    }

	public static function totalActivitiesPerZone($zone_id,$year_id){
        return DB::table('tfs_zonal_activities')
		  ->join('tfs_targets','tfs_targets.id','=','tfs_zonal_activities.target_id')		 
            ->where('tfs_zonal_activities.zone_id','=',$zone_id)         
            ->where('tfs_zonal_activities.year_id','=',$year_id)
            ->orderBy('number')
            ->get();
    }
	
	public static function totalTargetsPerObjective($zone_id,$objective_id,$year_id){
        return DB::table('tfs_zonal_activities')
			  ->join('tfs_targets','tfs_targets.id','=','tfs_zonal_activities.target_id')
			->select('tfs_targets.id as target')		  
            ->where('tfs_zonal_activities.zone_id','=',$zone_id)         
            ->where('tfs_zonal_activities.year_id','=',$year_id)
            ->where('tfs_targets.objective_id','=',$objective_id)
            ->groupby('target')
            ->get();
    }	
	
	public static function totalTargetsPerZone($zone_id,$year_id){
        return DB::table('tfs_zonal_activities')
			  ->join('tfs_targets','tfs_targets.id','=','tfs_zonal_activities.target_id')
			->select('tfs_targets.id as target')		  
            ->where('tfs_zonal_activities.zone_id','=',$zone_id)         
            ->where('tfs_zonal_activities.year_id','=',$year_id)
            ->groupby('target')
            ->get();
    }

    public static function getActivitiesToConsolidate($target_id,$year_id){
        return ZonalActivity::where('tfs_zonal_activities.target_id','=',$target_id)
            ->where('tfs_zonal_activities.year_id','=',$year_id)
            ->where('tfs_zonal_activities.is_combined','=',false)
            ->orderBy('number')
            ->get();
    }
	
	public static function is_activity_exist($code,$zone,$year_id){
		$activity = ZonalActivity::where('number','=',$code)
					->where('zone_id','=',$zone)
					->where('year_id','=',$year_id)
					->first();
		if(count($activity) > 0){
			return true;
		}else{
			return false;
		}
		
	}
	
	 public static function zonal_pending_activities($year_id){
        return DB::table('tfs_zonal_activities')
			  ->join('tfs_targets','tfs_targets.id','=','tfs_zonal_activities.target_id')
			  ->join('tfs_objectives','tfs_objectives.id','=','tfs_targets.objective_id')
			->select('tfs_objectives.ob_code as objective','tfs_targets.*')		  
              ->where('tfs_zonal_activities.is_combined','=',false)
              ->where('tfs_zonal_activities.year_id','=',$year_id)
				->orderBy('objective')
				->groupby('tfs_targets.id')
            ->get();
    }

    //FUNCTIONS
    public function zone(){
        return $this->belongsTo('Zone', 'zone_id', 'id');
    }

    public function items(){
        return $this->hasMany('ZonalItem');
    }
	

}