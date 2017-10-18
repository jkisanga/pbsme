<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 05/03/2016
 * Time: 15:30
 */

class RefProjection extends \Eloquent{

    protected $table = 'tfs_ref_projections';

    // Don't forget to fill this array
    protected $fillable = ['id', 'token'];



}