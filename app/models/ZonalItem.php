<?php


class ZonalItem extends  Eloquent{

    protected $table = 'tfs_zonal_items';

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

	//total zone activity cost
   	public static function zone_activity_total($zone,$activity){
        return DB::table('tfs_zonal_items')
		    ->join('tfs_items','tfs_items.id','=','tfs_zonal_items.item_id')
		    ->join('tfs_zonal_activities','tfs_zonal_activities.id','=','tfs_zonal_items.zonal_activity_id')
		    ->join('tfs_activities','tfs_activities.id','=','tfs_zonal_items.activity_id')
			->join('tfs_units','tfs_units.id','=','tfs_zonal_items.unit_id')
			->where('tfs_zonal_items.zonal_activity_id','=',$activity)			
			->where('tfs_units.zone_id','=',$zone)			
			->sum('cost');
    }

	//total zone target cost
   	public static function zone_target_total($zone,$target,$year_id	){
        return DB::table('tfs_zonal_items')
		     ->join('tfs_items','tfs_items.id','=','tfs_zonal_items.item_id')
		     ->join('tfs_zonal_activities','tfs_zonal_activities.id','=','tfs_zonal_items.zonal_activity_id')
			->join('tfs_units','tfs_units.id','=','tfs_zonal_items.unit_id')
			->where('tfs_zonal_activities.target_id','=',$target)
			->where('tfs_units.zone_id','=',$zone)
			->where('tfs_zonal_activities.year_id','=',$year_id	)		
			->sum('cost');
    }

	//total zone objective cost
   	public static function zone_objective_total($zone,$objective,$year_id){
        return DB::table('tfs_zonal_items')
		     ->join('tfs_items','tfs_items.id','=','tfs_zonal_items.item_id')
		     ->join('tfs_zonal_activities','tfs_zonal_activities.id','=','tfs_zonal_items.zonal_activity_id')
			->join('tfs_units','tfs_units.id','=','tfs_zonal_items.unit_id')
			->join('tfs_targets','tfs_targets.id','=','tfs_zonal_activities.target_id')
			->where('tfs_targets.objective_id','=',$objective)
			->where('tfs_units.zone_id','=',$zone)
			->where('tfs_zonal_activities.year_id','=',$year_id)
			->sum('cost');
    }	
	
	
	//total zone grand cost
   	public static function zone_grand_total($zone,$year_id){
        return DB::table('tfs_zonal_items')
		     ->join('tfs_items','tfs_items.id','=','tfs_zonal_items.item_id')
		     ->join('tfs_zonal_activities','tfs_zonal_activities.id','=','tfs_zonal_items.zonal_activity_id')
			->join('tfs_units','tfs_units.id','=','tfs_zonal_items.unit_id')
			->join('tfs_targets','tfs_targets.id','=','tfs_zonal_activities.target_id')
			->where('tfs_units.zone_id','=',$zone)
			->where('tfs_zonal_activities.year_id','=',$year_id)
			->sum('cost');
    }	
	
	//Zones budget summary
	
    public function zonesSummary($year_id){
        return  DB::select('
            SELECT tfs_zones.zone_name as zone,tfs_units.id as units,
              SUM(IF(tfs_objectives.ob_code="A",tfs_items.cost,NULL)) AS OBJECTIVEA,
              SUM(IF(tfs_objectives.ob_code="B",tfs_items.cost,NULL)) AS OBJECTIVEB,
              SUM(IF(tfs_objectives.ob_code="C",tfs_items.cost,NULL)) AS OBJECTIVEC,
              SUM(IF(tfs_objectives.ob_code="D",tfs_items.cost,NULL)) AS OBJECTIVED,
              SUM(IF(tfs_objectives.ob_code="E",tfs_items.cost,NULL)) AS OBJECTIVEE

            FROM tfs_zonal_items
					JOIN tfs_items ON tfs_items.id = tfs_zonal_items.item_id
					JOIN tfs_zonal_activities ON tfs_zonal_activities.id = tfs_zonal_items.zonal_activity_id
					JOIN tfs_units ON tfs_units.id = tfs_zonal_items.unit_id
					JOIN tfs_zones ON tfs_zones.id = tfs_units.zone_id
					JOIN tfs_targets ON tfs_targets.id = tfs_zonal_activities.target_id
					JOIN tfs_objectives ON tfs_objectives.id = tfs_targets.objective_id
           
            WHERE tfs_zonal_activities.year_id ='.$year_id.'
            GROUP BY zone
        ');
    } 

}