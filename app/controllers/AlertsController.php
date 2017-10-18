<?php

class AlertsController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
  
	public function __construct()
	{
        parent::__construct();
		
	}
	
	//pending HQ consolidation alerts
	public function pendingConsolidation()
	{
        $year = FinancialYear::where('status','=',true)->first();   
		$pending_targets = ZonalActivity::zonal_pending_activities($year->id);     
        //Layout
         return View::make('alerts.pending_consolidation',compact('pending_targets'));
             
	}
	//pending zone consolidation alerts
	public function pendingZoneConsolidation()
	{
        $year = FinancialYear::where('status','=',true)->first();   
		$pending_targets = Activity::unit_pending_activities($year->id,Auth::user()->unit->zone_id);    
        //Layout
         return View::make('alerts.pending_zone_consolidation',compact('pending_targets'));
             
	}

   



}
