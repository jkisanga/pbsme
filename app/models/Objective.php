<?php
/**
 * Created by PhpStorm.
 * User: tzchoice
 * Date: 9/28/2015
 * Time: 9:55 PM
 */
class Objective extends  Eloquent{
protected $table = 'tfs_objectives';

    public function financial(){
        return $this->belongsTo('FinancialYear', 'financial_id', 'id');
    }
    public function target()
    {
        return $this->hasMany('Target');
    }
}