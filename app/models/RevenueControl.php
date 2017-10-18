<?php

class RevenueControl extends Eloquent{

    protected $table = 'tfs_revenue_control';

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
  public function units_submitted_revenue($zone_id,$year_id){
          return DB::table('tfs_revenue_control')
            ->join('financial_years','financial_years.id','=','tfs_revenue_control.year_id')
            ->join('tfs_units','tfs_units.id','=','tfs_revenue_control.unit_id')
            ->join('tfs_zones','tfs_zones.id','=','tfs_units.zone_id')
            ->join('users','users.id','=','tfs_revenue_control.user_id')
            ->select('users.*','tfs_revenue_control.id as id','financial_years.year as year','tfs_units.name as unit','tfs_units.id as unit_id')
            ->where('financial_years.id','=',$year_id)
            ->where('tfs_zones.id','=',$zone_id)
            ->get();
    }
   
}