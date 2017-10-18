<?php

class UnitControl extends Eloquent{

    protected $table = 'tfs_unit_control';

    public function financial_year(){
        return $this->belongsTo('FinancialYear', 'year_id', 'id');
    }
    public function unit(){
        return $this->belongsTo('Unit', 'unit_id', 'id');
    }
    public function user(){
        return $this->belongsTo('Users', 'user_id', 'id');
    }

    public function is_submitted($year_id,$unit_id){
        $result =  $this->where('year_id','=',$year_id)->where('unit_id','=',$unit_id)->first();
        if(isset($result)){
            return true;
        }else{
            return false;
        }
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

    public function zoneUnitsSubmitted($zone_id,$year_id){
        return DB::table('tfs_units')
            ->join('tfs_unit_control','tfs_unit_control.unit_id','=','tfs_units.id')
            ->where('tfs_units.zone_id','=',$zone_id)
            ->where('tfs_units.deleted','=',0)            
            ->where('tfs_unit_control.year_id','=',$year_id)            
            ->get();
    }
}