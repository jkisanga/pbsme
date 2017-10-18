<?php

class GfsCode extends \Eloquent {

    // Add your validation rules here
    public static $rules = [
       
    ];
    protected $table = 'gfs_codes';

    // Don't forget to fill this array
    protected $fillable = ['item_description','code'];

}