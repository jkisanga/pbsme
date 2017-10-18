<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 02/03/2016
 * Time: 13:28
 */

class Unit extends  Eloquent{

    protected $table = 'tfs_units';

    public static $rules = [
        'name' => 'required',
        'description' => 'required'
    ];

    public function zone(){
        return $this->belongsTo('Zone', 'zone_id', 'id');
    }

    public function submissions(){
        return $this->hasMany('Submission');
    }

    public function projections(){
        return $this->hasMany('Projection');
    }

    public function getUnit($unitID){
        return DB::table('tfs_units')
            ->join('tfs_zones','tfs_zones.id','=','tfs_units.zone_id')
            ->select('tfs_units.*','tfs_zones.id as zone_id','tfs_zones.zone_name as zone','tfs_zones.short_name as initial')
            ->where('tfs_units.id','=',$unitID)
            ->first();
    }
	
	public function get_unit_activities($unit_id, $year_id){
		 return Activity:: where('unit_id','=',$unit_id)->where('year_id','=',$year_id)->count();
	}

    public function getSubmissions($unitID){
        return Unit::find($unitID)->submissions()->with('refSubmission')->get();
    }

    public function getProjections($unitID){
        return Unit::find($unitID)->projections()->with('refProjection')->get();
    }
}