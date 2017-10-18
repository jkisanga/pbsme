<?php

class RefUnitMeasure extends \Eloquent {

    // Add your validation rules here
    public static $rules = [
        'description' => 'required'
    ];
    protected $table = 'tfs_ref_unit_measures';

    // Don't forget to fill this array
    protected $fillable = ['description'];


}