<?php

class BaseController extends Controller {

    /**
     * Initializer.
     *
     * @access   public
     * @return \BaseController
     */
    protected $year;
    protected $pending_consolidation;
    protected $pending_zonal_consolidation;
    protected $current_unit;
	protected $unitControl;

    public function __construct() 
    {
        // Fetch the Site Settings object
		
		$this->year= FinancialYear::where('status','=',true)->first();
        $this->pending_consolidation = ZonalActivity::zonal_pending_activities($this->year->id);                   
        $this->beforeFilter('csrf', array('on' => 'post'));
		$this->current_unit = Unit::where('id','=',Auth::user()->unit_id)->first();
		$this->pending_zonal_consolidation = Activity::unit_pending_activities($this->year->id,$this->current_unit->zone_id); 
		
		
		
		//Get unit pending submmision
		$this->unitControl = UnitControl::submitted_budget_global($this->current_unit->zone_id);
		$zoneUnits = Unit::where('zone_id','=',$this->current_unit->zone_id)->where('deleted','=',0)->get();
        $submitted_budgets = $this->unitControl;
		$pending_unit_submission = count($zoneUnits) - count($submitted_budgets);
		
		
		//get zone pending submmision
		$submitted_budgets = ZoneControl::submitted_zone_budget_global();
		$zones = Zone::all();
		$pending_zone_submission = count($zones)-count($submitted_budgets);
		
		
		
		

		View::share(
		array(
		'pending_zonal_consolidation'=> $this->pending_zonal_consolidation,
		'pending_consolidation'=> $this->pending_consolidation,
		'current_year'=>$this->year->year,
		'current_unit'=>$this->current_unit,
		'pending_unit_submission' => $pending_unit_submission,
		'pending_zone_submission' => $pending_zone_submission
		)
		);
    }

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{


		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}