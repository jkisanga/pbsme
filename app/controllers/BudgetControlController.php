<?php


class BudgetControlController extends BaseController
{
    protected $unitControl;
    protected $zoneControl;
	protected $unit;


    public function __construct(UnitControl $unitControl,ZoneControl $zoneControl, Unit $unit){
        parent::__construct();
        $this->unitControl = $unitControl;
        $this->zoneControl = $zoneControl;
        $this->unit = $unit;
    }


     public function getIndex(){
         $financial_year = FinancialYear::where('status','=',1)->first();
		 $unit = $this->unit->getUnit(Auth::user()->unit_id);
		 $zoneUnits = Unit::where('zone_id','=',$unit->zone_id)->where('deleted','=',0)->get();
	
		 $unitsSubmittedBudget = $this->unitControl->zoneUnitsSubmitted($unit->zone_id,$financial_year->id);
		 $unit_submited = $this->unitControl->is_submitted($financial_year->id,Auth::user()->unit_id);
		 $is_submitted = ZoneControl::is_submitted($financial_year->id,$unit->zone_id);
		//Layout
	
        $view = View::make('budget_control/index',compact('financial_year','unit','unit_submited'));
		$view->nest('zone_budget_submit_view','action.partials.zone_control',
			[
				'financial_year'=>$financial_year,
				'unit'=>$unit,
				'zoneUnits'=>$zoneUnits,
				'is_submitted'=>$is_submitted,
				'unitsSubmittedBudget'=>$unitsSubmittedBudget
			]);
		return $view;
     }
	//submit unit budget
    public function postIndex(){
        //
        $rules = [
            'year_id'=>'required',
        ];
        $valid = Validator::make(Input::all(),$rules);
        if($valid->passes()){
            if($this->unitControl->is_submitted(Input::get('year_id'),Auth::user()->unit_id)){
                return Redirect::back()->with('warning', 'Budget already submitted');
            }else{
				if($this->unit->get_unit_activities(Auth::user()->unit_id,Input::get('year_id')) > 1){
					$BudgetSubmit = new UnitControl();
					$BudgetSubmit->year_id = Input::get('year_id');
					$BudgetSubmit->unit_id = Auth::user()->unit_id;
					$BudgetSubmit->user_id = Auth::user()->id;
					$BudgetSubmit->save();
					return Redirect::back()->with('success', 'Budget has been submitted');
				}else{
					return Redirect::back()->with('warning', 'Add activities and items before you submit!');
				}             
            }
        }else{
            return Redirect::back()->withInput()->withErrors($valid);
        }
    }  

	//Submit Zonal Budget
	public function zonalSubmit(){
        $rules = [
            'year_id'=>'required',
        ];
        $valid = Validator::make(Input::all(),$rules);
	$unit = Unit::find(Auth::user()->unit_id);
	$pending = Activity::unit_pending_activities(Input::get('year_id'),$unit->zone_id); 
	
        if($valid->passes()){
            if($this->zoneControl->is_submitted(Input::get('year_id'),$unit->zone_id)){
                return Redirect::back()->with('warning', 'Budget already submitted');
            }elseif(count($pending) > 0){
            	//return var_dump($pending);
            	return Redirect::back()->with('warning', 'consolidation is not completed');
            }else{
                $ZoneBudgetSubmit = new ZoneControl();
                $ZoneBudgetSubmit->year_id = Input::get('year_id');
                $ZoneBudgetSubmit->zone_id = $unit->zone_id;
                $ZoneBudgetSubmit->user_id = Auth::user()->id;
                $ZoneBudgetSubmit->save();
             
                return Redirect::to('budget/submit')->with('success', 'Budget has been submitted');
            }
        }else{
            return Redirect::back()->withInput()->withErrors($valid);
        }
    }
	
	//units management submitted
	public function manage_zone(){
		$year = FinancialYear::where('status','=',true)->first(); 
		$unit = $this->unit->getUnit(Auth::user()->unit_id);
		$zoneUnits = Unit::where('zone_id','=',$unit->zone_id)->where('deleted','=',0)->get();
        $submitted_budgets = $this->unitControl->submitted_budget($unit->zone_id);
		$pending = count($zoneUnits)-count($submitted_budgets);
		$is_submitted = ZoneControl::is_submitted($year->id,$unit->zone_id);
		
		 return View::make('budget_control/submitted_budgets',
			 [
			 'zoneUnits'=>$zoneUnits,
			 'submitted_budgets'=>$submitted_budgets,
			 'pending'=>$pending,
			 'financial_year'=>$year,
			 'is_submitted'=>$is_submitted
			 ]
		 );
	}
	//Unlock Unit Budget
    public function unlock($id){
        $budget = UnitControl::find($id);
        $budget->delete();
        return Redirect::back()->with('success', 'Budget has been unlocked');
    }
	
	
	//zones submitted
	public function manage_overall(){
		$year = FinancialYear::where('status','=',true)->first(); 
        $submitted_budgets = $this->zoneControl->submitted_zone_budget();
		$zones = Zone::all();
		$pending = count($zones)-count($submitted_budgets);
	
		
		return View::make('budget_control/submitted_zones',
		[
			'zones'=>$zones,
			'submitted_budgets'=>$submitted_budgets,
			'pending'=>$pending,
			'financial_year'=>$year
		]);
	}
	//Unlock Zone Budget	
    public function unlockZone($id){
        $budget = ZoneControl::find($id);
        $budget->delete();
        return Redirect::back()->with('success', 'Budget has been unlocked');
    }

    public function getZoneConsolidation(){
        $financialYear = FinancialYear::where('status','=',true)->first();
        $objectives = Objective::orderBy('ob_code')->get();
        $unit = Unit::find(Auth::User()->unit_id);
        $zoneUnits = Unit::where('zone_id','=',$unit->zone_id)->where('deleted','=',0)->get();
        $unitsSubmittedBudget = $this->unitControl->zoneUnitsSubmitted($unit->zone->id, $financialYear->id);
		$is_submitted = ZoneControl::is_submitted($financialYear->id,$unit->zone_id);

        if(isset($financialYear)){
			if($is_submitted){
				return Redirect::to('budget/zone/manage')->with('warning','Budget for the current financial year has been submitted.');
			}
            return View::make('budget_control/zoneConsolidation', compact('unit','zoneUnits','unitsSubmittedBudget', 'objectives','financialYear'));
        }else{
            return Redirect::back()->with('warning','No active financial year, contact system administrator.');
        }
    }


    // START ZONE ACTIVITY CONSOLIDATION
    public function getZonalConsolidation($target_id){

        $financialYear = FinancialYear::where('status','=',true)->first();
        $unit = Unit::find(Auth::User()->unit_id);
        $zoneUnits = Unit::where('zone_id','=',$unit->zone_id)->where('deleted','=',0)->get();
        $unitsSubmittedBudget = $this->unitControl->zoneUnitsSubmitted($unit->zone->id, $financialYear->id);
        $target  = Target::find($target_id);
       $activities = Activity::getActivitiesToConsolidateByZone($unit->zone_id,$target->id,$financialYear->id);
       	
        $zonalActivities =ZonalActivity::where('target_id','=',$target->id)->where('year_id','=',$financialYear->id)->where('zone_id','=',$unit->zone_id)->get();

        if(isset($target)){
    //check if all units have submitted their budget
            if(count($zoneUnits) == count($unitsSubmittedBudget)){
                return View::make('budget_control/zoneNewActivity', compact('unit','financialYear','target','activities','zonalActivities'));
            }else{
                return Redirect::back()->with('warning','Make sure all units/districts have submitted their budgets');
            }
        }else{
            return Redirect::back();
        }
    }

    public function postZoneActivityConsolidation(){
        $rules = [
            'activities' => 'required',
            'number' => 'required',
            'description' => 'required',
            'type' => 'required'
        ];

        $valid = Validator::make($data = Input::all(),$rules);
		$unit = Unit::find(Auth::User()->unit_id);
		
        if($valid->passes()){
            $activitiesSelected = $data['activities'];
      //Create new zonal activity
                $zone_activity = new ZonalActivity();
                $zone_activity->zone_id = $data['zone_id'];
                $zone_activity->target_id = $data['target_id'];
                $zone_activity->year_id = $data['year_id'];
                $zone_activity->number = $data['number'];
                $zone_activity->description = $data['description'];
                $zone_activity->type = $data['type'];
                $zone_activity->user_id = Auth::user()->id;
				
		//check duplication of Activity number on the same zone
		if(ZonalActivity::is_activity_exist($zone_activity->number,$unit->zone_id,$data['year_id']) == false)
			{
               if($zone_activity->save()){
        //update the original unit activity
                   foreach($activitiesSelected as $activity_id) {
                                     	
                       $activity = Activity::find($activity_id);
                      
                       //$originalActivity = Activity::find($activity->id);
                       if (isset($activity )) {
                           $activity ->is_combined = true;
                           $activity ->save();
                       }
					   
                //Link new activity with all items
                       $savedActivity = ZonalActivity::find($zone_activity->id);
                       $items = $activity->items;
                       foreach ($items as $item) {
                           $zone_item = new ZonalItem();
                           $zone_item->item_id = $item->id;
                           $zone_item->activity_id = $item->activity_id;
                           $zone_item->zonal_activity_id = $savedActivity->id;
                           $zone_item->unit_id = $activity->unit_id;
                           $zone_item->save();
                       }
                   }
                   return Redirect::back()->with('success','New Activity has been created');
               }else{
                   return Redirect::back()->withInput()->with('error','activity not Created');
               }
			}else{
				 return Redirect::back()->withInput()->with('warning','Activity number already created');
			}

        }else{
            return Redirect::back()->withInput()->withErrors($valid);
        }
    }
	
	//Delete Zonal Activity 
	public function deleteZonalActivity($id){
		
		$activity = ZonalActivity::find($id);
		
		foreach($activity->items as $item ){
			//change activity status
				$unit_activity = Activity::find($item->activity_id);
				$unit_activity->is_combined = false;
				$unit_activity->save();
				
			//delete item
				$item->delete();			
		}
		
		//delete zonal activity
		if($activity->delete()){
				return Redirect::back()->with('success','Activity has been removed');
		}else{
			return Redirect::back()->with('error','Activity failed to be removed');
		}
	}

    // --END ZONE ACTIVITY CONSOLIDATION--


    // START TFS HQ ACTIVITY CONSOLIDATION
    public function getOverAll(){
        $financialYear = FinancialYear::where('status','=',true)->first();
        $objectives = Objective::orderBy('ob_code')->get();
        $zones = Zone::all();
        //$unitsSubmittedBudget = $this->unitControl->zoneUnitsSubmitted($unit->zone->id);

        if(isset($financialYear)){
            return View::make('budget_control/overAllConsolidation', compact('zones','objectives','financialYear'));
        }else{
            return Redirect::back()->with('warning','No active financial year, contact system administrator.');
        }
    }

    public function getOverAllConsolidation($target_id){

        $financialYear = FinancialYear::where('status','=',true)->first();
        $target  = Target::find($target_id);
        $activities = ZonalActivity::getActivitiesToConsolidate($target->id,$financialYear->id);
        $overAllActivities = ConsolidateActivity::where('target_id','=',$target->id)->where('year_id','=',$financialYear->id)->get();
		
		$zones = Zone::all();
        $zonesSubmittedBudget = $this->zoneControl->submitted_zone_budget();	

        if(isset($target)){
            //should be changed to check if all zones have submitted their budget
			if(count($zones)==count($zonesSubmittedBudget)){
				 return View::make('budget_control/newOverAllActivity', compact('financialYear','target','activities','overAllActivities'));
			}else{
				 return Redirect::back()->with('warning','Make sure all zones have submitted their budgets');
			}           
        }else{
            return Redirect::back();
        }
    }

    public function postOverAllActivityConsolidation(){
        $rules = [
            'activities' => 'required',
            'number' => 'required',
            'description' => 'required',
            'type' => 'required'
        ];

        $valid = Validator::make($data = Input::all(),$rules);
        if($valid->passes()){
            $activitiesSelected = $data['activities'];
            //Create new zonal activity
            $consolidated_activity = new ConsolidateActivity();
            $consolidated_activity->target_id = $data['target_id'];
            $consolidated_activity->year_id = $data['year_id'];
            $consolidated_activity->number = $data['number'];
            $consolidated_activity->description = $data['description'];
            $consolidated_activity->type = $data['type'];
            $consolidated_activity->user_id = Auth::user()->id;
            
         if(ConsolidateActivity::is_activity_exist( $consolidated_activity->number , $consolidated_activity->year_id)==false ){

            if($consolidated_activity->save()){
                //update the original unit activity
                foreach($activitiesSelected as $activity_id) {
                    $activity = ZonalActivity::find($activity_id);
                    $originalActivity = ZonalActivity::find($activity->id);
                    if (isset($originalActivity)) {
                        $originalActivity->is_combined = true;
                        $originalActivity->save();
                    }

                    //Link new activity with all items
                    $savedActivity = ConsolidateActivity::find($consolidated_activity->id);
                    $items = $activity->items;
                    foreach ($items as $item) {
                        $consolidated_item = new ConsolidatedItem();
                        $consolidated_item->item_id = $item->item_id;
                        $consolidated_item->consolidated_activity_id = $savedActivity->id;
                        $consolidated_item->unit_id = $item->unit_id;
                        $consolidated_item->save();
                    }
                }
                return Redirect::back()->with('success','New Activity has been created');
            }else{
                return Redirect::back()->with('error','activity not Created');
            }
            }else{
             	return Redirect::back()->with('warning','activity number already Created');
            }

        }else{
            return Redirect::back()->withInput()->withErrors($valid);
        }
    }
	
	//Delete HQ Activity 
	public function deleteHqActivity($id){
		
		$activity = ConsolidateActivity::find($id);
		
		foreach($activity->items as $item ){
			//change zone activity status
			
			$zonalItem = ZonalItem::where('item_id','=',$item->item_id)->first();
			$zone_activity = ZonalActivity::find($zonalItem->zonal_activity_id);
				
			$zone_activity->is_combined = false;
			$zone_activity->save();
				
			//delete overall item
				$item->delete();			
		}
		
		//delete overall activity
		if($activity->delete()){
				return Redirect::back()->with('success','Activity has been removed');
		}else{
			return Redirect::back()->with('error','Activity failed to be removed');
		}
	}

}