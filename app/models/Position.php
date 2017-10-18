<?php

class Position extends Eloquent {

public static  $rules = [
'title'=>'required',
];
// Don't forget to fill this array
    protected $fillable = ['id', 'title', 'description'];

}
