<?php


class RevenueControlController extends BaseController
{
    protected $revenueControl;
	protected $unit;


    public function __construct(RevenueControl $revenueControl, Unit $unit){
        parent::__construct();
        $this->revenueControl = $revenueControl;
        $this->unit = $unit;
    }


     public function getIndex(){
         $financial_year = FinancialYear::where('status','=',true)->first();
		 $unit = $this->unit->getUnit(Auth::user()->unit_id);
		 $zoneUnits = Unit::where('zone_id','=',$unit->zone_id)->where('deleted','=',0)->get();
	
		 $unitsSubmittedRevenue = $this->revenueControl->units_submitted_revenue($unit->zone_id,$financial_year->id);
		 $unit_submited = $this->revenueControl->is_submitted($financial_year->id,Auth::user()->unit_id);
		
		//Layout
	
        $view = View::make('revenue_control/index',compact('financial_year','unit','unit_submited','unitsSubmittedRevenue'));	
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
            if($this->revenueControl->is_submitted(Input::get('year_id'),Auth::user()->unit_id)){
                return Redirect::back()->with('warning', 'Revenue already submitted');
            }else{
				
					$revenue_submit = new RevenueControl();
					$revenue_submit->year_id = Input::get('year_id');
					$revenue_submit->unit_id = Auth::user()->unit_id;
					$revenue_submit->user_id = Auth::user()->id;
					$revenue_submit->save();
					return Redirect::back()->with('success', 'Revenue has been submitted');
				            
            }
        }else{
            return Redirect::back()->withInput()->withErrors($valid);
        }
    }  

	//units management submitted
	public function manage(){
		$year = FinancialYear::where('status','=',true)->first(); 
		$unit = $this->unit->getUnit(Auth::user()->unit_id);
		$zoneUnits = Unit::where('zone_id','=',$unit->zone_id)->where('deleted','=',0)->get();
        $submitted_revenue = $this->revenueControl->units_submitted_revenue($unit->zone_id,$year->id);
		$pending = count($zoneUnits)-count($submitted_revenue);
		$is_submitted = $this->revenueControl->is_submitted($year->id,$unit->id);
		
		 return View::make('revenue_control/submitted_revenue',
			 [
			 'zoneUnits'=>$zoneUnits,
			 'submitted_revenue'=>$submitted_revenue,
			 'pending'=>$pending,
			 'financial_year'=>$year,
			 'is_submitted'=>$is_submitted
			 ]
		 );
	}
	
	//Unlock Unit Budget
    public function unlock($id){
        $budget = RevenueControl::find($id);
        $budget->delete();
        return Redirect::back()->with('success', 'Budget has been unlocked');
    }
	
	
}