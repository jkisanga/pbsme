<?php

class HomeController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
  
	protected $year;
    protected $unit;
    protected $zonalItem;
    protected $unitControl;
    protected $zoneControl;

    public function __construct(
        FinancialYear $year,       
        Unit $unit,
        ZonalItem $zonalItem,
        UnitControl $unitControl,
        ZoneControl $zoneControl
    ){

        parent::__construct();
        $this->year = $year;     
        $this->unit = $unit;
        $this->zonalItem = $zonalItem;
        $this->unitControl = $unitControl;
        $this->zoneControl = $zoneControl;
    }

   
	public function dashboard()
	{
       
		$year = FinancialYear::where('status','=',true)->first();  
		$unit = $this->unit->getUnit(Auth::user()->unit_id);
		$zones = Zone::where('deleted','=',false)->get();
		$pending_consolidation = ZonalActivity::zonal_pending_activities($year->id);
       //$submitted_zone_budgets = $this->zoneControl->submitted_zone_budget();
	   
	   //Charts
	    $labels = [];
		$data = [];
        $total = 0;
	    $budgets = $this->zonalItem->zonesSummary($year->id);
		 
			foreach($budgets as $budget){
			$labels[]=$budget->zone;
			$data[] = $budget->OBJECTIVEA +$budget->OBJECTIVEB + $budget->OBJECTIVEC + $budget->OBJECTIVED + $budget->OBJECTIVEE;
                $total = $total + ($budget->OBJECTIVEA +$budget->OBJECTIVEB + $budget->OBJECTIVEC + $budget->OBJECTIVED + $budget->OBJECTIVEE);
            }

        //Layout
        $view = View::make('home.dashboard',['unit'=>$unit,'year'=>$year,'labels'=>$labels,'data'=>$data, 'budgets' => $budgets, 'total' => $total]);
        $view->nest('pending_consolidation_view','home.partials.pending_consolidation',['pending_consolidation'=>$pending_consolidation]);      
        $view->nest('zones_budget_chart_view','home.partials.zones_budget_chart',[]);

        return $view;
    }

	


}
