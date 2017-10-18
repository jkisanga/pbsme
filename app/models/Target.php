<?php
/**
 * Created by PhpStorm.
 * User: tzchoice
 * Date: 9/28/2015
 * Time: 10:34 PM
 */

class Target extends Eloquent{

    protected $table = 'tfs_targets';


    //static methods

    public static function getTargetByObjective($objective_id){

        return Target::where('objective_id','=',$objective_id)->orderBy('target_no')->get();
    }

    public function objective(){
        return $this->belongsTo('Objective','objective_id','id');
    }
    public function activities()
    {
        return $this->hasMany('Activity');
    }
}