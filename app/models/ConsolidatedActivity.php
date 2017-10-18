<?php


class ConsolidateActivity extends  Eloquent
{

    protected $table = 'tfs_consolidated_activities';

    public static function getOverallActivities($target_id,$year_id){
        return DB::table('tfs_consolidated_activities')
            ->where('tfs_consolidated_activities.target_id','=',$target_id)
            ->where('tfs_consolidated_activities.year_id','=',$year_id)
            ->orderBy('number')
            ->get();
    }
	
 public function items(){
        return $this->hasMany('ConsolidatedItem','consolidated_activity_id');
    }
    
    public static function is_activity_exist($code,$year_id){
		$activity = ConsolidateActivity ::where('number','=',$code)				
					->where('year_id','=',$year_id)
					->first();
		if(count($activity) > 0){
			return true;
		}else{
			return false;
		}
		
	}
}
