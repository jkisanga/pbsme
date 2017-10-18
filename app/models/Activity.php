<?php
/**
 * Created by PhpStorm.
 * User: tzchoice
 * Date: 9/29/2015
 * Time: 1:17 AM
 */

class Activity extends Eloquent{

    protected $table ='tfs_activities';


    //static functions

    public static function getActivitiesByZone($zone_id,$target_id,$year_id){
        return DB::table('tfs_activities')
            ->where('tfs_activities.zone_id','=',$zone_id)
            ->where('tfs_activities.target_id','=',$target_id)
            ->where('tfs_activities.year_id','=',$year_id)
            ->orderBy('activity_no')
            ->groupBy('activity_no')
            ->get();
    }
	// list of all zone activities by target
    public static function getActivitiesToConsolidateByZone($zone_id,$target_id,$year_id){
        return DB::table('tfs_activities')
            ->join('tfs_units','tfs_units.id','=','tfs_activities.unit_id')
            ->select('tfs_activities.*', 'tfs_units.name')
            ->where('tfs_units.deleted','=',0)
			->where('tfs_activities.zone_id','=',$zone_id)
           ->where('tfs_activities.target_id','=',$target_id)
		   ->where('tfs_activities.year_id','=',$year_id)
            ->where('tfs_activities.is_combined','=',false)
			->orderBy('activity_no')
            ->get();
    }
    

    //end

    public function items(){
        return $this->hasMany('Item');
    }

    public function targted(){
        return $this->belongsTo('Target');
    }

    public function getActivitiesByUnit($unitID,$active_year){
        return DB::table('tfs_items')
            ->join('tfs_activities','tfs_activities.id','=','tfs_items.activity_id')
            ->join('tfs_targets','tfs_targets.id','=','tfs_activities.target_id')
            ->join('tfs_objectives','tfs_objectives.id','=','tfs_targets.objective_id')
            ->where('tfs_activities.unit_id','=',$unitID)
            ->where('tfs_activities.year_id',$active_year)
            ->sum('cost');
    }


    public function getActivitiesByZoneUnits($unit_id,$zone_id,$target_id){
        return DB::table('tfs_activities')
            ->join('tfs_units','tfs_units.id','=','tfs_activities.unit_id')
            ->where('tfs_units.zone_id','=',$zone_id)
            ->where('tfs_activities.target_id','=',$target_id)
            ->where('tfs_units.id','=',$unit_id)
         
            ->get();
    }

    public function unit(){
        return $this->belongsTo('Unit', 'unit_id', 'id');
    }
	
	 public static function unit_pending_activities($year_id,$zone_id){
        return DB::table('tfs_activities')
			  ->join('tfs_targets','tfs_targets.id','=','tfs_activities.target_id')
			->join('tfs_objectives','tfs_objectives.id','=','tfs_targets.objective_id')
			   ->join('tfs_unit_control','tfs_unit_control.unit_id','=','tfs_activities.unit_id')
			->select('tfs_objectives.ob_code as objective','tfs_targets.*')	
			
              ->where('tfs_activities.is_combined','=',false) 
              ->where('tfs_activities.year_id','=',$year_id)
              ->where('tfs_unit_control.year_id','=',$year_id)
              ->where('tfs_activities.zone_id','=',$zone_id)
             
				->orderBy('objective')
				->orderBy('tfs_targets.target_no')
				->groupby('tfs_targets.id')
				
           ->get();
    }
}