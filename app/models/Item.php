<?php
/**
 * Created by PhpStorm.
 * User: tzchoice
 * Date: 9/29/2015
 * Time: 10:18 AM
 */

class Item extends Eloquent{

    protected $table = 'tfs_items';


    //static functions

    public  static function getItemsByTarget($target_id){
        return DB::select('SELECT
          tfs_items.item_code,
          tfs_items.input_description,
          tfs_items.unit_of_measure,
          tfs_items.cost,
          sum(tfs_items.no_of_unit) as quantity,
          sum(tfs_items.cost) as total
        FROM tfs_items
          INNER JOIN tfs_activities
            ON tfs_items.activity_id = tfs_activities.id
        WHERE tfs_activities.target_id = '.$target_id.'
        GROUP BY tfs_items.item_code
        ORDER BY tfs_items.item_code
        ');
    }

    public static function getItemsTotalByTarget($target_id){
        return DB::select('SELECT
                sum(tfs_items.cost) as total
        FROM tfs_items
          INNER JOIN tfs_activities
            ON tfs_items.activity_id = tfs_activities.id
        WHERE tfs_activities.target_id = '.$target_id.'
        GROUP BY tfs_items.item_code
        ORDER BY tfs_items.item_code
        ');
    }

    public static function getZonalItems($zonal_activity_id){
        return DB::select('
            SELECT
             tfs_items.item_code,
          tfs_items.input_description,
          tfs_items.unit_of_measure,
          tfs_items.unit_cost,
          tfs_items.cost,
          sum(tfs_items.total_unit) as quantity,
          sum(tfs_items.cost) as total
            FROM tfs_zonal_items
            INNER JOIN tfs_zonal_activities
            ON tfs_zonal_items.zonal_activity_id = tfs_zonal_activities.id
            INNER JOIN tfs_items
            ON tfs_zonal_items.item_id = tfs_items.id
            Where tfs_zonal_items.zonal_activity_id = '.$zonal_activity_id.'
            GROUP BY tfs_items.item_code
            ORDER BY tfs_items.item_code
        ');
    }

    public static function getOverallItems($consolidated_activity_id){
        return DB::select('
            SELECT
             tfs_items.item_code,
          tfs_items.input_description,
          tfs_items.unit_of_measure,
          tfs_items.unit_cost,
          tfs_items.cost,
          sum(tfs_items.no_of_unit) as quantity,
          sum(tfs_items.cost) as total
            FROM tfs_consolidated_items
            INNER JOIN tfs_consolidated_activities
            ON tfs_consolidated_items.consolidated_activity_id = tfs_consolidated_activities.id
            INNER JOIN tfs_items
            ON tfs_consolidated_items.item_id = tfs_items.id
            Where tfs_consolidated_items.consolidated_activity_id = '.$consolidated_activity_id.'
            GROUP BY tfs_items.item_code
            ORDER BY tfs_items.item_code
        ');
    }
	
	//total unit activity cost
    public static function activity_total($id,$year_id){
        return Item::where('activity_id','=',$id)->sum('cost');
    }
	//total unit Target cost
	public static function target_total($id,$unit_id,$year_id){
        return DB::table('tfs_items')
		     ->join('tfs_activities','tfs_activities.id','=','tfs_items.activity_id')
			->where('tfs_activities.target_id','=',$id)
			->where('tfs_activities.unit_id','=',$unit_id)
			->where('tfs_activities.year_id','=',$year_id)
			->sum('cost');
    }	
	
	//total unit objective cost
	public static function objective_total($id,$unit_id,$year_id){
        return DB::table('tfs_items')
		     ->join('tfs_activities','tfs_activities.id','=','tfs_items.activity_id')
		     ->join('tfs_targets','tfs_targets.id','=','tfs_activities.target_id')
			->where('tfs_targets.objective_id','=',$id)
			->where('tfs_activities.unit_id','=',$unit_id)
			->where('tfs_activities.year_id','=',$year_id)
			->sum('cost');
    }

	//total unit objective grand total cost
	public static function unit_grand_total($unit_id,$year_id){
        return DB::table('tfs_items')
		     ->join('tfs_activities','tfs_activities.id','=','tfs_items.activity_id')
		     ->join('tfs_targets','tfs_targets.id','=','tfs_activities.target_id')	
			->where('tfs_activities.unit_id','=',$unit_id)
			->where('tfs_activities.year_id','=',$year_id)
			->sum('cost');
    }

    public function activity(){
        return $this->belongsTo('Activity', 'activity_id', 'id');
    }
//Zones budget summary
	
    public function unitsSummary($year_id,$zone_id){
        return  DB::select('
            SELECT tfs_units.name as unit,
              SUM(IF(tfs_objectives.ob_code="A",tfs_items.cost,NULL)) AS OBJECTIVEA,
              SUM(IF(tfs_objectives.ob_code="B",tfs_items.cost,NULL)) AS OBJECTIVEB,
              SUM(IF(tfs_objectives.ob_code="C",tfs_items.cost,NULL)) AS OBJECTIVEC,
              SUM(IF(tfs_objectives.ob_code="D",tfs_items.cost,NULL)) AS OBJECTIVED,
              SUM(IF(tfs_objectives.ob_code="E",tfs_items.cost,NULL)) AS OBJECTIVEE

            FROM tfs_items
					JOIN tfs_activities ON tfs_activities.id = tfs_items.activity_id
					JOIN tfs_units ON tfs_units.id = tfs_activities.unit_id
					JOIN tfs_targets ON tfs_targets.id = tfs_activities.target_id
					JOIN tfs_objectives ON tfs_objectives.id = tfs_targets.objective_id
           
            WHERE tfs_activities.year_id ='.$year_id.'
            AND tfs_units.zone_id ='.$zone_id.'
            GROUP BY unit
        ');
    } 
   
	
}