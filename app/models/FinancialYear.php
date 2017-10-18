<?php
/**
 * Created by PhpStorm.
 * User: tzchoice
 * Date: 9/25/2015
 * Time: 7:20 PM
 */
class FinancialYear extends  Eloquent{

    public static $rules = [
        'year' => 'required',
        'projection_percentage' => 'required'
    ];

    // Don't forget to fill this array
    protected $fillable = ['id', 'token'];

}