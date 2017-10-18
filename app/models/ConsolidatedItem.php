<?php

class ConsolidatedItem extends  Eloquent
{

    protected $table = 'tfs_consolidated_items';
	
	
	//total TFS activity cost
   	public static function tfs_activity_total($activity){
        return DB::table('tfs_consolidated_items')
		    ->join('tfs_items','tfs_items.id','=','tfs_consolidated_items.item_id')
		    ->join('tfs_consolidated_activities','tfs_consolidated_activities.id','=','tfs_consolidated_items.consolidated_activity_id')
			->where('tfs_consolidated_items.consolidated_activity_id','=',$activity)						
			->sum('cost');
    }

	//total TFS target cost
   	public static function tfs_target_total($target,$year_id){
        return DB::table('tfs_consolidated_items')
		    ->join('tfs_items','tfs_items.id','=','tfs_consolidated_items.item_id')
		    ->join('tfs_consolidated_activities','tfs_consolidated_activities.id','=','tfs_consolidated_items.consolidated_activity_id')
			->where('tfs_consolidated_activities.target_id','=',$target)						
			->where('tfs_consolidated_activities.year_id','=',$year_id)						
			->sum('cost');
    }

	//total TFS objective cost
   	public static function tfs_objective_total($objective,$year_id){
        return DB::table('tfs_consolidated_items')
		    ->join('tfs_items','tfs_items.id','=','tfs_consolidated_items.item_id')
		    ->join('tfs_consolidated_activities','tfs_consolidated_activities.id','=','tfs_consolidated_items.consolidated_activity_id')
			->join('tfs_targets','tfs_targets.id','=','tfs_consolidated_activities.target_id')
			->where('tfs_targets.objective_id','=',$objective)
			->where('tfs_consolidated_activities.year_id','=',$year_id)			
			->sum('cost');
    }	
	
	
	//total TFS grand cost
   	public static function tfs_grand_total($year_id){
         return DB::table('tfs_consolidated_items')
		    ->join('tfs_items','tfs_items.id','=','tfs_consolidated_items.item_id')
		    ->join('tfs_consolidated_activities','tfs_consolidated_activities.id','=','tfs_consolidated_items.consolidated_activity_id')
			->join('tfs_targets','tfs_targets.id','=','tfs_consolidated_activities.target_id')
			->where('tfs_consolidated_activities.year_id','=',$year_id)
			->sum('cost');
    }	

}