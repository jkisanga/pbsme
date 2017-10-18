<?php namespace Andrew13\Helpers;

use Carbon\Carbon;
use tidy;

class String {

    /**
     * Capatilize first letter of each word of a string.
     *
     * @param string  $value
     * @return string
     */
    public static function title($value)
    {
        return mb_convert_case($value, MB_CASE_TITLE);
    }

    /**
     * @param $value
     * @internal param $html
     * @return string
     */
    public static function tidy($value)
    {
        // Check to see if Tidy is available.
        if(class_exists('tidy')) {
            $tidy = new tidy();
            return  $tidy->repairString($value, array(
                'show-body-only' => true,
            ));
        } else { // No Tidy, Time for regex and possibly a broken DOM :(
            preg_match_all('#<(?!meta|img|br|hr|input\b)\b([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $value, $result);
            $openedtags = $result[1];
            preg_match_all('#</([a-z]+)>#iU', $value, $result);
            $closedtags = $result[1];
            $len_opened = count($openedtags);
            if (count($closedtags) == $len_opened) {
                return $value;
            }
            $openedtags = array_reverse($openedtags);
            for ($i=0; $i < $len_opened; $i++) {
                if (!in_array($openedtags[$i], $closedtags)) {
                    $value .= '</'.$openedtags[$i].'>';
                } else {
                    unset($closedtags[array_search($openedtags[$i], $closedtags)]);
                }
            }
            return $value;
        }
    }

    public static function date(Carbon $date)
    {
        if($date->diffInDays(Carbon::now()) < 7) {
            return $date->diffForHumans();
        } else {
            return $date->toFormattedDateString();
        }
    }

    //Money Format
    public static function formatMoney($number, $fractional=false) {
    
    	return  number_format((float)$number,0,'.',',');
        
    }
	
	//Calculate foward budget number of units using projection percentage
	
	 public static function project_units($factor,$input) {
		$projection = (($factor/100)*$input);
    	return  number_format($projection + $input,0);       
    }
	
	//Calculate foward budget cost using projection percentage
	public static function project_cost($factor,$input,$unit_cost) {
		$projection = (($factor/100)*$input);
		$projection_units = $projection + $input;
		$cost = $projection_units *$unit_cost;		
		return  $cost;
       
    }
}