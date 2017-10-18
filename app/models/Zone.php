<?php
/**
 * Created by PhpStorm.
 * User: tzchoice
 * Date: 9/25/2015
 * Time: 7:20 PM
 */
class Zone extends  Eloquent{

protected $table = 'tfs_zones';

    public static $rules = [
        'zone_name' => 'required',
        'short_name' => 'required'
    ];
	
	 public function units(){
        return $this->hasMany('Unit');
    }
}