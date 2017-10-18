<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 09/03/2016
 * Time: 08:51
 */
 
  session_start();

class ReportsController extends BaseController{

    protected $objective;
    protected $target;
    protected $activity;
    protected $item;
    protected $zonalItem;
    protected $unit;

    public function __construct(Objective $objective, Target $target, Activity $activity, Item $item,Unit $unit,ZonalItem $zonalItem)
    {
        parent::__construct();
        $this->objective = $objective;
        $this->target = $target;
        $this->activity = $activity;
        $this->item = $item;
        $this->zonalItem = $zonalItem;
        $this->unit = $unit;
    }

// -------UNIT BUDGET REPORT------
    public function getUnitBudget(){
        $years = FinancialYear::all();
		$unit = Unit::find(Auth::user()->unit_id);
		$units = Unit::where('zone_id','=',$unit->zone_id)->where('deleted','=',0)->get();

        //Layout
        $view = View::make('reports/unitBudgetView',['years'=>$years,'units'=>$units,'unit'=>$unit]);
        $view->nest('reports_view','reports.htmlViews.unitBudgetHtml');
		$view->nest('export_buttons','reports.includes.unit-header-button');
        return $view;
		
    }

    public function postUnitBudget(){

        $rules = [
            'year' =>'required',
        ];

        $valid = Validator::make($data = Input::all(), $rules);

        if ($valid->passes()) {

            $objective_id = $data['objective_id'];
            $financialYear = FinancialYear::find($data['year']);
            $years = FinancialYear::all();
            $unit = Unit::find(Auth::user()->unit_id);
			$units = Unit::where('zone_id','=',$unit->zone_id)->where('deleted','=',0)->get();
			
			if(isset($data['unit'])){
				$unit = Unit::find($data['unit']);
			}

            //start session
            //session_start();

            //unset current session data
            unset($_SESSION['unit']);
            unset($_SESSION['financialYear']);
            unset( $_SESSION['selectedObjective'] );
            unset( $_SESSION['objectives']);

            //set new data
            $_SESSION['unit'] =$unit ;
            $_SESSION['financialYear'] = $financialYear;
            $_SESSION['selectedObjective'] = null;
            $_SESSION['objectives'] = null;

            if(isset($objective_id) && $objective_id >0){
                $selectedObjective = $this->objective->find($objective_id);
                //add print parameter to session
                $_SESSION['selectedObjective'] = $selectedObjective;
                //Layout
                $view = View::make('reports/unitBudgetView',['years'=>$years,'units'=>$units,'unit'=>$unit]);
                $view->nest('reports_view','reports.htmlViews.unitBudgetHtml',['selectedObjective'=>$selectedObjective, 'unit'=>$unit,'financialYear'=>$financialYear]);
				$view->nest('export_buttons','reports.includes.unit-header-button',['selectedObjective'=>$selectedObjective]);
                return $view;

            }else{

                $objectives = $this->objective->orderBy('ob_code')->get();

                //add print parameter to session
                $_SESSION['objectives'] = $objectives;

                //Layout
                $view = View::make('reports/unitBudgetView',['years'=>$years,'units'=>$units,'unit'=>$unit]);
                $view->nest('reports_view','reports.htmlViews.unitBudgetHtml',['objectives'=>$objectives, 'unit'=>$unit,'financialYear'=>$financialYear]);
				$view->nest('export_buttons','reports.includes.unit-header-button',['objectives'=>$objectives]);
                return $view;

            }

        }else{

            return Redirect::back()
                ->withInput()
                ->withErrors($valid);
        }

    }

    public function downloadUnitBudget(){
       // session_start();

        if(isset($_SESSION['unit']) && isset($_SESSION['financialYear']) || isset($_SESSION['selectedObjective']) || isset($_SESSION['objectives'])){

            $parameter['unit'] =  $_SESSION['unit'] ;
            $parameter['financialYear'] = $_SESSION['financialYear'] ;
            $parameter['selectedObjective'] =    $_SESSION['selectedObjective'];
            $parameter['objectives'] =  $_SESSION['objectives'];

            //$pdf = PDF::loadView('reports/htmlViews/unitBudgetHtml',$parameter);
           // return $pdf->download('unit_budget.pdf');

            $headers = array(
                "Content-type"=>"application/ms-excel",
                "Content-Disposition"=>"attachment;Filename=unit_budget.xls"
            );
            $content = View::make('reports/htmlViews/unitBudgetHtml',$parameter);
            return Response::make($content,200, $headers);

        }else{
            return Redirect::back();
        }

    }


		//--ZONES REPORT
    public function getZonesBudget(){
        $years = FinancialYear::all();
        $unit = $this->unit->getUnit(Auth::user()->unit_id);	
        $zone = Zone::find($unit->zone_id);	
		$zones = Zone::where('deleted','=',0)->get();

        //Layout
        $view = View::make('reports/zonesBudgetView',['years'=>$years,'zones'=>$zones,'zone'=>$zone]);
        $view->nest('reports_view','reports.htmlViews.zonesBudgetHtml');
		$view->nest('export_buttons','reports.includes.zones-header-button');
        return $view;

    }

    public function postZonesBudget(){

        $rules = [
            'year' =>'required',
           
        ];

        $valid = Validator::make($data = Input::all(), $rules);

        if ($valid->passes()) {

            $objective_id = $data['objective_id'];
            $financialYear = FinancialYear::find($data['year']);
            $years = FinancialYear::all();
            $zones = Zone::where('deleted','=',0)->get();
			$unit = Unit::find(Auth::user()->unit_id);
            $zone = Zone::find($unit->zone_id);
			
			if(isset($data['zone'])){
				$zone = Zone::find($data['zone']);
			}

            //start session
          
            //unset current session data
          
		    unset($_SESSION['zone']);
            unset($_SESSION['financialYear']);
            unset( $_SESSION['selectedObjective'] );
            unset( $_SESSION['objectives']);

            //set new data
            $_SESSION['zone'] =$zone ;
            $_SESSION['financialYear'] = $financialYear;
            $_SESSION['selectedObjective'] = null;
            $_SESSION['objectives'] = null;

            if(isset($objective_id) && $objective_id >0){
				
                $selectedObjective = $this->objective->find($objective_id);
				     //add print parameter to session
				$_SESSION['selectedObjective']=  $selectedObjective;

                //Layout
                $view = View::make('reports/zonesBudgetView',['years'=>$years,'zones'=>$zones,'zone'=>$zone]);
                $view->nest('reports_view','reports.htmlViews.zonesBudgetHtml',['selectedObjective'=>$selectedObjective, 'zone'=>$zone,'financialYear'=>$financialYear]);
                $view->nest('export_buttons','reports.includes.zones-header-button',['selectedObjective'=>$selectedObjective]);
                return $view;
            }else{

                $objectives = $this->objective->orderBy('ob_code')->get();
				     //add print parameter to session
				$_SESSION['objectives'] = $objectives;

                //Layout
                $view = View::make('reports/zonesBudgetView',['years'=>$years,'zones'=>$zones,'zone'=>$zone]);
                $view->nest('reports_view','reports.htmlViews.zonesBudgetHtml',['objectives'=>$objectives, 'zone'=>$zone,'financialYear'=>$financialYear]);
				$view->nest('export_buttons','reports.includes.zones-header-button',['objectives'=>$objectives]);
                return $view;
            }

        }else{
            return Redirect::back()
                ->withInput()
                ->withErrors($valid);
        }
    }

    public function downloadZoneBudget(){
     
        if(isset($_SESSION['zone']) && isset($_SESSION['financialYear']) || isset($_SESSION['selectedObjective']) || isset($_SESSION['objectives'])){

            $parameter['zone'] =  $_SESSION['zone'] ;
            $parameter['financialYear'] = $_SESSION['financialYear'] ;
            $parameter['selectedObjective'] =    $_SESSION['selectedObjective'];
            $parameter['objectives'] =  $_SESSION['objectives'];

            //$pdf = PDF::loadView('reports/htmlViews/unitBudgetHtml',$parameter);
            // return $pdf->download('unit_budget.pdf');

            $headers = array(
                "Content-type"=>"application/ms-excel",
                "Content-Disposition"=>"attachment;Filename=zone_budget.xls"
            );
            $content = View::make('reports/htmlViews/zonesBudgetHtml',$parameter);
            return Response::make($content,200, $headers);

        }else{
            return Redirect::back();
        }

    }


// -------UNIT BUDGET REPORT------
    public function getZoneBudget(){
        $years = FinancialYear::all();
        return View::make('reports/zoneBudgetView',compact('years'));
    }

    public function postZoneBudget(){

        $rules = [
            'year' =>'required',
        ];

        $valid = Validator::make(Input::all(), $rules);

        if ($valid->passes()) {
            $objective_id = Input::get('objective_id');
            $financialYear = FinancialYear::find(Input::get('year'));
            $years = FinancialYear::all();
            $unit = Unit::find(Auth::user()->unit_id);

            if(isset($objective_id) && $objective_id >0){
                $objective = $this->objective->find(Input::get('objective_id'));
                return View::make('reports/zoneBudgetViewObjective', compact('years', 'objective', 'unit','financialYear',
                    'data'));
            }else{
                $objectives = $this->objective->all();
                return View::make('reports/zoneBudgetView', compact('years', 'objectives', 'unit','financialYear'));
            }
        }else{

            return Redirect::back()
                ->withInput()
                ->withErrors($valid);
        }

    }

    //OVERALL BUDGET---------------------------------------------------####################

    public function getOverallBudget(){
        $years = FinancialYear::all();
		
		  //Layout
        $view = View::make('reports/overallBudgetView',['years'=>$years]);
        $view->nest('reports_view','reports.htmlViews.overallBudgetHtml');
		$view->nest('export_buttons','reports.includes.overall-header-button');
        return $view;
    }

    public function postOverallBudget(){

        $rules = [
            'year' =>'required',
        ];

        $valid = Validator::make($data = Input::all(), $rules);

        if ($valid->passes()) {

            $objective_id = $data['objective_id'];
            $financialYear = FinancialYear::find($data['year']);
            $years = FinancialYear::all();
			
			
            unset($_SESSION['financialYear']);
            unset( $_SESSION['selectedObjective'] );
            unset( $_SESSION['objectives']);

            //set new data   
            $_SESSION['financialYear'] = $financialYear;
			$_SESSION['selectedObjective'] = null;
			$_SESSION['objectives'] = null;
           
            if(isset($objective_id) && $objective_id >0){
                $selectedObjective = $this->objective->find($objective_id);
				$_SESSION['selectedObjective'] =  $selectedObjective;
               				
				   //Layout
                $view = View::make('reports/overallBudgetView',['years'=>$years]);
                $view->nest('reports_view','reports.htmlViews.overallBudgetHtml',['selectedObjective'=>$selectedObjective,'financialYear'=>$financialYear]);
				$view->nest('export_buttons','reports.includes.overall-header-button',['selectedObjective'=>$selectedObjective]);
                return $view;
            }else{

                $objectives = $this->objective->orderBy('ob_code')->get();
				  $_SESSION['objectives'] =  $objectives;
				  //Layout
                $view = View::make('reports/overallBudgetView',['years'=>$years]);
                $view->nest('reports_view','reports.htmlViews.overallBudgetHtml',['objectives'=>$objectives,'financialYear'=>$financialYear]);
				$view->nest('export_buttons','reports.includes.overall-header-button',['objectives'=>$objectives]);
                return $view;
              
            }

        }else{

            return Redirect::back()
                ->withInput()
                ->withErrors($valid);
        }
    }
	
	   public function downloadOverallBudget(){
     
        if(isset($_SESSION['financialYear']) || isset($_SESSION['selectedObjective']) || isset($_SESSION['objectives'])){
          
            $parameter['financialYear'] = $_SESSION['financialYear'] ;
            $parameter['selectedObjective'] =    $_SESSION['selectedObjective'];
            $parameter['objectives'] =  $_SESSION['objectives'];
					

            //$pdf = PDF::loadView('reports/htmlViews/overallBudgetHtml',$parameter);
            // return $pdf->download('overall_budget.pdf');

            $headers = array(
                "Content-type"=>"application/ms-excel",
                "Content-Disposition"=>"attachment;Filename=overall_budget.xls"
            );
            $content = View::make('reports/htmlViews/overallBudgetHtml',$parameter);
            return Response::make($content,200, $headers);

        }else{
            return Redirect::back();
        }
    }

	
	//Summary of Budget Estimates per unit and Objective

    public function getSummaryUnitBudgetView(){
        $years = FinancialYear::all();
	     
		 $view = View::make('reports/SummaryUnitBudgetView',['years'=>$years]);
		 $view->nest('reports_view','reports.htmlViews.summaryUnitBudgetHtml');
		 return $view;
    }
	
	  public function postSummaryUnitBudgetView(){
        $years = FinancialYear::all();
        $rules = [
            'year' =>'required'
        ];
		
		unset($_SESSION['financialYear'] );
		unset($_SESSION['budgets']);
		unset($_SESSION['objA']);
		unset($_SESSION['objB']);
		unset($_SESSION['objC']);
		unset($_SESSION['objD']);
		unset($_SESSION['objE']);
		unset($_SESSION['total']);

        $valid = Validator::make($data = Input::all(), $rules);

        if ($valid->passes()) {
			$financialYear = FinancialYear::find($data['year']);
			$unit = Unit::find(Auth::user()->unit_id);
			$zone = Zone::find($unit->zone_id);
            $budgets = $this->item->unitsSummary($data['year'],$unit->zone_id);
			
			$_SESSION['financialYear'] = $financialYear;
			$_SESSION['budgets'] = $budgets;
			$_SESSION['zone'] = $zone;
			
			//sum of unit budget per objective
			$objA = 0;
			$objB = 0;
			$objC = 0;
			$objD = 0;
			$objE = 0;
			$total = 0;
			
			foreach($budgets as $budget){
				
				$objA = $objA+$budget->OBJECTIVEA;
				$objB = $objB+$budget->OBJECTIVEB;
				$objC = $objC+$budget->OBJECTIVEC;
				$objD = $objD+$budget->OBJECTIVED;
				$objE = $objE+$budget->OBJECTIVEE;
				$total = $total + ($budget->OBJECTIVEA +$budget->OBJECTIVEB + $budget->OBJECTIVEC + $budget->OBJECTIVED + $budget->OBJECTIVEE);				
			}
			
			$_SESSION['objA'] = $objA;
			$_SESSION['objB'] = $objB;
			$_SESSION['objC'] = $objC;
			$_SESSION['objD'] = $objD;
			$_SESSION['objE'] = $objE;
			$_SESSION['total'] = $total;
			
			//end
		
			 $view = View::make('reports/SummaryUnitBudgetView',['budgets'=>$budgets,'years'=>$years]);
             $view->nest('reports_view','reports.htmlViews.summaryUnitBudgetHtml',
					[
						'budgets'=>$budgets,
						'financialYear'=>$financialYear,
						'zone'=>$zone,
						'objA'=>$objA,
						'objB'=>$objB,
						'objC'=>$objC,
						'objD'=>$objD,
						'objE'=>$objE,
						'total'=>$total
					]);
             return $view;
        }else{
            return Redirect::back()
                ->withInput()
                ->withErrors($valid);
        }
    }
	
	 public function downloadUnitSummaryBudget(){
     
        if(isset($_SESSION['financialYear']) || isset($_SESSION['budgets']) ){
          
            $parameter['financialYear'] = $_SESSION['financialYear'] ;
            $parameter['budgets'] = $_SESSION['budgets'];
            $parameter['zone'] = $_SESSION['zone'];
			$parameter['objA'] = $_SESSION['objA'];
			$parameter['objB'] = $_SESSION['objB'];
			$parameter['objC'] = $_SESSION['objC'];
			$parameter['objD'] = $_SESSION['objD'];
			$parameter['objE'] = $_SESSION['objE'];
			$parameter['total'] = $_SESSION['total'];
           					
            $headers = array(
                "Content-type"=>"application/ms-excel",
                "Content-Disposition"=>"attachment;Filename=summary_per_unit_budget.xls"
            );
            $content = View::make('reports/htmlViews/summaryUnitBudgetHtml',$parameter);
            return Response::make($content,200, $headers);

        }else{
            return Redirect::back();
        }
    }

    //Summary of Budget Estimates per zone/station and Objective

    public function getSummaryZoneBudgetView(){
        $years = FinancialYear::all();
       
		 $view = View::make('reports/SummaryZoneBudgetView',['years'=>$years]);
		 $view->nest('reports_view','reports.htmlViews.summaryBudgetHtml');
		 return $view;
    }

    public function postSummaryZoneBudgetView(){
        $years = FinancialYear::all();
        $rules = [
            'year' =>'required'
        ];
		
		unset($_SESSION['financialYear'] );
		unset(	$_SESSION['budgets']);

        $valid = Validator::make($data = Input::all(), $rules);

        if ($valid->passes()) {
			$financialYear = FinancialYear::find($data['year']);
            $budgets = $this->zonalItem->zonesSummary($data['year']);
			
			$_SESSION['financialYear'] = $financialYear;
			$_SESSION['budgets'] = $budgets;
			
				//sum of unit budget per objective
			$objA = 0;
			$objB = 0;
			$objC = 0;
			$objD = 0;
			$objE = 0;
			$total = 0;
			
			foreach($budgets as $budget){
				
				$objA = $objA+$budget->OBJECTIVEA;
				$objB = $objB+$budget->OBJECTIVEB;
				$objC = $objC+$budget->OBJECTIVEC;
				$objD = $objD+$budget->OBJECTIVED;
				$objE = $objE+$budget->OBJECTIVEE;
				$total = $total + ($budget->OBJECTIVEA +$budget->OBJECTIVEB + $budget->OBJECTIVEC + $budget->OBJECTIVED + $budget->OBJECTIVEE);				
			}
			
			$_SESSION['objA'] = $objA;
			$_SESSION['objB'] = $objB;
			$_SESSION['objC'] = $objC;
			$_SESSION['objD'] = $objD;
			$_SESSION['objE'] = $objE;
			$_SESSION['total'] = $total;
			
			//end
		
			 $view = View::make('reports/SummaryZoneBudgetView',['budgets'=>$budgets,'years'=>$years]);
             $view->nest('reports_view','reports.htmlViews.summaryBudgetHtml',
					[
						'budgets'=>$budgets,
						'financialYear'=>$financialYear,
						'objA'=>$objA,
						'objB'=>$objB,
						'objC'=>$objC,
						'objD'=>$objD,
						'objE'=>$objE,
						'total'=>$total
					]);
             return $view;
        }else{
            return Redirect::back()
                ->withInput()
                ->withErrors($valid);
        }
    }
	
	   public function downloadSummaryBudget(){
     
        if(isset($_SESSION['financialYear']) || isset($_SESSION['budgets']) ){
          
            $parameter['financialYear'] = $_SESSION['financialYear'] ;
            $parameter['budgets'] =    $_SESSION['budgets'];
			$parameter['objA'] = $_SESSION['objA'];
			$parameter['objB'] = $_SESSION['objB'];
			$parameter['objC'] = $_SESSION['objC'];
			$parameter['objD'] = $_SESSION['objD'];
			$parameter['objE'] = $_SESSION['objE'];
			$parameter['total'] = $_SESSION['total'];
           					
            $headers = array(
                "Content-type"=>"application/ms-excel",
                "Content-Disposition"=>"attachment;Filename=summary_budget.xls"
            );
            $content = View::make('reports/htmlViews/summaryBudgetHtml',$parameter);
            return Response::make($content,200, $headers);

        }else{
            return Redirect::back();
        }
    }
	
	
		
	  //Summary of Budget distribution per zone/station and Objective

    public function zonalDistribution(){     		 
		$years = FinancialYear::all();
        $unit = $this->unit->getUnit(Auth::user()->unit_id);	
        $zone = Zone::find($unit->zone_id);	

        //Layout
        $view = View::make('reports/zonesDistributionView',['years'=>$years,'zone'=>$zone]);
        $view->nest('reports_view','reports.htmlViews.zonesDistributionHtml');
		$view->nest('export_buttons','reports.includes.zones-distribution-header-button');
        return $view;
    }
	
	 public function postZonalDistribution(){
        $rules = [
            'year' =>'required',
            'zone' =>'required',
        ];

        $valid = Validator::make($data = Input::all(), $rules);

        if ($valid->passes()) {

            $financialYear = FinancialYear::find($data['year']);
            $years = FinancialYear::all();
            $zones = Zone::all();
            $zone = Zone::find($data['zone']);
          
            //unset current session data
          
		    unset($_SESSION['zone']);
            unset($_SESSION['financialYear']);
            unset( $_SESSION['objectives']);

            //set new data
            $_SESSION['zone'] =$zone ;
            $_SESSION['financialYear'] = $financialYear;
            $_SESSION['objectives'] = null;
			$_SESSION['total_average'] = null;
           

       
			$objectives = $this->objective->orderBy('ob_code')->get();
				 //add print parameter to session
			$_SESSION['objectives'] = $objectives;
			
			//Average
				
			$total_average = 0;
				 	
			foreach($objectives as $objective){
				
					$total = ZonalItem::zone_objective_total($zone->id,$objective->id,$financialYear->id );
					$grand_total = ZonalItem::zone_grand_total($zone->id,$financialYear->id);
					if($grand_total > 0){
							$average = number_format(($total /$grand_total)*100,1);
							$total_average = $total_average+$average;
					}
			}  
			$_SESSION['total_average'] = $total_average;
			 
			
			//Layout
			$view = View::make('reports/zonesDistributionView',['years'=>$years,'zone'=>$zone]);
			$view->nest('reports_view','reports.htmlViews.zonesDistributionHtml',['objectives'=>$objectives, 'zone'=>$zone,'financialYear'=>$financialYear,'total_average'=>$total_average]);
			$view->nest('export_buttons','reports.includes.zones-distribution-header-button',['objectives'=>$objectives]);
			return $view;
            

        }else{
            return Redirect::back()
                ->withInput()
                ->withErrors($valid);
        }
    }
	
	//download zone budget distribution
	   public function downloadZoneDistribution(){
     
        if(isset($_SESSION['zone']) && isset($_SESSION['financialYear']) || isset($_SESSION['total_average']) || isset($_SESSION['objectives'])){

            $parameter['zone'] =  $_SESSION['zone'] ;
            $parameter['financialYear'] = $_SESSION['financialYear'] ;
            $parameter['total_average'] =    $_SESSION['total_average'];
            $parameter['objectives'] =  $_SESSION['objectives'];

            //$pdf = PDF::loadView('reports/htmlViews/unitBudgetHtml',$parameter);
            // return $pdf->download('unit_budget.pdf');

            $headers = array(
                "Content-type"=>"application/ms-excel",
                "Content-Disposition"=>"attachment;Filename=zone_budget_distribution.xls"
            );
            $content = View::make('reports/htmlViews/zonesDistributionHtml',$parameter);
            return Response::make($content,200, $headers);

        }else{
            return Redirect::back();
        }

    }
	
	
	//Unit form3c 
	public function getUnitForm3c(){
        $years = FinancialYear::all();
		$unit = Unit::find(Auth::user()->unit_id);
		$units = Unit::where('zone_id','=',$unit->zone_id)->where('deleted','=',0)->get();
		
		//$items = DB::table('tfs_items')->select('item_code')->groupBy('item_code')->get();
		$items = Item::groupBy('item_code')->selectRaw('*, sum(cost) as totalCost')->get();
		
		//return var_dump($items);
        //Layout
        $view = View::make('reports/unitForm3cView',['years'=>$years,'units'=>$units,'unit'=>$unit]);
        $view->nest('reports_view','reports.htmlViews.unitForm3cHtml');
		$view->nest('export_buttons','reports.includes.unit-form3c-header-button');
        return $view;
    }

    public function postUnitForm3c(){

        $rules = [
            'year' =>'required',
        ];

        $valid = Validator::make($data = Input::all(), $rules);

        if ($valid->passes()) {


            $financialYear = FinancialYear::find($data['year']);
			
			
			$str_yr = explode('/', $financialYear->year);
			$year1 = $str_yr[1];
			$year2 = $str_yr[1] +1;
			$year3 = $str_yr[1] +2;
			
			$forward_et1 = $year1."/". $year2;
			$forward_et2 = $year2."/". $year3;
			
            $years = FinancialYear::all();
            $unit = Unit::find(Auth::user()->unit_id);
			$units = Unit::where('zone_id','=',$unit->zone_id)->where('deleted','=',0)->get();
			
			if(isset($data['unit'])){
				$unit = Unit::find($data['unit']);
			}

            //start session
            //session_start();

            //unset current session data
            unset($_SESSION['unit']);
            unset($_SESSION['financialYear']);
            unset( $_SESSION['items']);
            unset( $_SESSION['forward_et1']);
            unset( $_SESSION['forward_et2']);

            //set new data
            $_SESSION['unit'] =$unit ;
            $_SESSION['financialYear'] = $financialYear;
            $_SESSION['items'] = null;
			
            $_SESSION['forward_et1'] = $forward_et1;
            $_SESSION['forward_et2'] = $forward_et2;

 

				$items = DB::table('tfs_activities')
				->join('tfs_items','tfs_items.activity_id', '=', 'tfs_activities.id' )
				->groupBy('tfs_items.item_code')->selectRaw('tfs_items.*, sum(tfs_items.cost) as totalCost')
				->where('tfs_activities.year_id', '=', $financialYear->id)
				->where('tfs_activities.unit_id', '=', $unit->id)
				->orderBy('tfs_items.item_code')->get();
				
				$grandTotalCost = 0;
				$grandTotalCostForwad1 = 0;
				$grandTotalCostForwad2 = 0;
				foreach($items as $item){
					$grandTotalCost = $grandTotalCost + $item->totalCost;
					$grandTotalCostForwad1 = $grandTotalCostForwad1 + (5/100 *($item->totalCost) + $item->totalCost);
					$grandTotalCostForwad2 = $grandTotalCostForwad2 + (10/100 *($item->totalCost) + $item->totalCost);
				}
			
                //add print parameter to session
                $_SESSION['items'] = $items;
                $_SESSION['grandTotalCost'] = $grandTotalCost;
				 $_SESSION['grandTotalCostForwad1'] = $grandTotalCostForwad1;
				$_SESSION['grandTotalCostForwad2'] = $grandTotalCostForwad2;

                //Layout
                $view = View::make('reports/unitForm3cView',['years'=>$years,'units'=>$units,'unit'=>$unit]);
                $view->nest('reports_view','reports.htmlViews.unitForm3cHtml',['items'=>$items, 
				'unit'=>$unit,'financialYear'=>$financialYear, 
				'grandTotalCost' => $grandTotalCost,
				'forward_et1' => $forward_et1,
				'forward_et2' => $forward_et2,
				'grandTotalCostForwad1' => $grandTotalCostForwad1,
				'grandTotalCostForwad2' => $grandTotalCostForwad2,
				
				]);
				$view->nest('export_buttons','reports.includes.unit-form3c-header-button',['items'=>$items]);
                return $view;

          

        }else{

            return Redirect::back()
                ->withInput()
                ->withErrors($valid);
        }

    }
	
	
	
    public function downloadUnitForm3c(){
       // session_start();

        if(isset($_SESSION['unit']) && isset($_SESSION['financialYear']) || isset($_SESSION['items'])){

            $parameter['unit'] =  $_SESSION['unit'] ;
            $parameter['financialYear'] = $_SESSION['financialYear'] ;
            $parameter['items'] =  $_SESSION['items'];
            $parameter['grandTotalCost'] =  $_SESSION['grandTotalCost'];
			 $parameter['forward_et1'] =  $_SESSION['forward_et1'];
            $parameter['forward_et2'] =  $_SESSION['forward_et2'];
            $parameter['grandTotalCostForwad1'] =  $_SESSION['grandTotalCostForwad1'];
            $parameter['grandTotalCostForwad2'] =  $_SESSION['grandTotalCostForwad2'];

            //$pdf = PDF::loadView('reports/htmlViews/unitBudgetHtml',$parameter);
           // return $pdf->download('unit_budget.pdf');

            $headers = array(
                "Content-type"=>"application/ms-excel",
                "Content-Disposition"=>"attachment;Filename=unit_form3c.xls"
            );
            $content = View::make('reports/htmlViews/unitForm3cHtml',$parameter);
            return Response::make($content,200, $headers);

        }else{
            return Redirect::back();
        }

    }
	
	//end unit form3c
	
	
	//Zonal Form3c start
	public function getZoneForm3c(){
        $years = FinancialYear::all();
		$unit = Unit::find(Auth::user()->unit_id);
		$units = Unit::where('zone_id','=',$unit->zone_id)->where('deleted','=',0)->get();
		
		
        //Layout
        $view = View::make('reports/zoneForm3cView',['years'=>$years,'units'=>$units,'unit'=>$unit]);
        $view->nest('reports_view','reports.htmlViews.zoneForm3cHtml');
		$view->nest('export_buttons','reports.includes.zone-form3c-header-button');
        return $view;
    }

    public function postZoneForm3c(){

        $rules = [
            'year' =>'required',
        ];

        $valid = Validator::make($data = Input::all(), $rules);

        if ($valid->passes()) {


            $financialYear = FinancialYear::find($data['year']);
			
			
			$str_yr = explode('/', $financialYear->year);
			$year1 = $str_yr[1];
			$year2 = $str_yr[1] +1;
			$year3 = $str_yr[1] +2;
			
			$forward_et1 = $year1."/". $year2;
			$forward_et2 = $year2."/". $year3;
			
            $years = FinancialYear::all();
            $unit = Unit::find(Auth::user()->unit_id);
			$units = Unit::where('zone_id','=',$unit->zone_id)->where('deleted','=',0)->get();
			
			if(isset($data['unit'])){
				$unit = Unit::find($data['unit']);
			}

            //start session
            //session_start();

            //unset current session data
            unset($_SESSION['unit']);
            unset($_SESSION['financialYear']);
            unset( $_SESSION['items']);
            unset( $_SESSION['forward_et1']);
            unset( $_SESSION['forward_et2']);
            unset( $_SESSION['forward_et2']);
            unset( $_SESSION['grandTotalCostForwad1']);
            unset( $_SESSION['grandTotalCostForwad2']);

            //set new data
            $_SESSION['unit'] =$unit ;
            $_SESSION['financialYear'] = $financialYear;
            $_SESSION['items'] = null;
			
            $_SESSION['forward_et1'] = $forward_et1;
            $_SESSION['forward_et2'] = $forward_et2;
           

 

				$items = DB::table('tfs_activities')
				->join('tfs_items','tfs_items.activity_id', '=', 'tfs_activities.id' )
				->groupBy('tfs_items.item_code')->selectRaw('tfs_items.*, sum(tfs_items.cost) as totalCost')
				->where('tfs_activities.year_id', '=', $financialYear->id)
				->where('tfs_activities.zone_id', '=', $unit->zone_id)
				->orderBy('tfs_items.item_code')->get();
				
				$grandTotalCost = 0;
				$grandTotalCostForwad1 = 0;
				$grandTotalCostForwad2 = 0;
				foreach($items as $item){
					$grandTotalCost = $grandTotalCost + $item->totalCost;
					$grandTotalCostForwad1 = $grandTotalCostForwad1 + (5/100 *($item->totalCost) + $item->totalCost);
					$grandTotalCostForwad2 = $grandTotalCostForwad2 + (10/100 *($item->totalCost) + $item->totalCost);
				}
			
                //add print parameter to session
                $_SESSION['items'] = $items;
                $_SESSION['grandTotalCost'] = $grandTotalCost;
				 $_SESSION['grandTotalCostForwad1'] = $grandTotalCostForwad1;
				$_SESSION['grandTotalCostForwad2'] = $grandTotalCostForwad2;

                //Layout
                $view = View::make('reports/zoneForm3cView',['years'=>$years,'units'=>$units,'unit'=>$unit]);
                $view->nest('reports_view','reports.htmlViews.zoneForm3cHtml',['items'=>$items, 
				'unit'=>$unit,'financialYear'=>$financialYear, 
				'grandTotalCost' => $grandTotalCost,
				'forward_et1' => $forward_et1,
				'forward_et2' => $forward_et2,
				'grandTotalCostForwad1' => $grandTotalCostForwad1,
				'grandTotalCostForwad2' => $grandTotalCostForwad2
				
				]);
				$view->nest('export_buttons','reports.includes.zone-form3c-header-button',['items'=>$items]);
                return $view;

          

        }else{

            return Redirect::back()
                ->withInput()
                ->withErrors($valid);
        }

    }
	
	
	
    public function downloadZoneForm3c(){
       // session_start();

        if(isset($_SESSION['unit']) && isset($_SESSION['financialYear']) || isset($_SESSION['items'])){

            $parameter['unit'] =  $_SESSION['unit'] ;
            $parameter['financialYear'] = $_SESSION['financialYear'] ;
            $parameter['items'] =  $_SESSION['items'];
            $parameter['grandTotalCost'] =  $_SESSION['grandTotalCost'];
            $parameter['forward_et1'] =  $_SESSION['forward_et1'];
            $parameter['forward_et2'] =  $_SESSION['forward_et2'];
            $parameter['grandTotalCostForwad1'] =  $_SESSION['grandTotalCostForwad1'];
            $parameter['grandTotalCostForwad2'] =  $_SESSION['grandTotalCostForwad2'];

            //$pdf = PDF::loadView('reports/htmlViews/unitBudgetHtml',$parameter);
           // return $pdf->download('unit_budget.pdf');

            $headers = array(
                "Content-type"=>"application/ms-excel",
                "Content-Disposition"=>"attachment;Filename=zone_form3c.xls"
            );
            $content = View::make('reports/htmlViews/zoneForm3cHtml',$parameter);
            return Response::make($content,200, $headers);

        }else{
            return Redirect::back();
        }

    }
	
	//end Zonal form3c
	
	
	
	
	
	
		
	
	//HQ Form3c start
	public function getHQForm3c(){
        $years = FinancialYear::all();
		$unit = Unit::find(Auth::user()->unit_id);
		$units = Unit::where('zone_id','=',$unit->zone_id)->where('deleted','=',0)->get();
		
		
        //Layout
        $view = View::make('reports/hqForm3cView',['years'=>$years,'units'=>$units,'unit'=>$unit]);
        $view->nest('reports_view','reports.htmlViews.zoneForm3cHtml');
		$view->nest('export_buttons','reports.includes.zone-form3c-header-button');
        return $view;
    }

    public function postHQForm3c(){

        $rules = [
            'year' =>'required',
        ];

        $valid = Validator::make($data = Input::all(), $rules);

        if ($valid->passes()) {


            $financialYear = FinancialYear::find($data['year']);
			
			
			$str_yr = explode('/', $financialYear->year);
			$year1 = $str_yr[1];
			$year2 = $str_yr[1] +1;
			$year3 = $str_yr[1] +2;
			
			$forward_et1 = $year1."/". $year2;
			$forward_et2 = $year2."/". $year3;
			
            $years = FinancialYear::all();
            $unit = Unit::find(Auth::user()->unit_id);
			$units = Unit::where('zone_id','=',$unit->zone_id)->where('deleted','=',0)->get();
			
			if(isset($data['unit'])){
				$unit = Unit::find($data['unit']);
			}

            //start session
            //session_start();

            //unset current session data
            unset($_SESSION['unit']);
            unset($_SESSION['financialYear']);
            unset( $_SESSION['items']);
            unset( $_SESSION['forward_et1']);
            unset( $_SESSION['forward_et2']);
            unset( $_SESSION['forward_et2']);
            unset( $_SESSION['grandTotalCostForwad1']);
            unset( $_SESSION['grandTotalCostForwad2']);

            //set new data
            $_SESSION['unit'] =$unit ;
            $_SESSION['financialYear'] = $financialYear;
            $_SESSION['items'] = null;
			
            $_SESSION['forward_et1'] = $forward_et1;
            $_SESSION['forward_et2'] = $forward_et2;
           

 

				$items = DB::table('tfs_activities')
				->join('tfs_items','tfs_items.activity_id', '=', 'tfs_activities.id' )
				->groupBy('tfs_items.item_code')->selectRaw('tfs_items.*, sum(tfs_items.cost) as totalCost')
				->where('tfs_activities.year_id', '=', $financialYear->id)
				->orderBy('tfs_items.item_code')->get();
				
				$grandTotalCost = 0;
				$grandTotalCostForwad1 = 0;
				$grandTotalCostForwad2 = 0;
				foreach($items as $item){
					$grandTotalCost = $grandTotalCost + $item->totalCost;
					$grandTotalCostForwad1 = $grandTotalCostForwad1 + (5/100 *($item->totalCost) + $item->totalCost);
					$grandTotalCostForwad2 = $grandTotalCostForwad2 + (10/100 *($item->totalCost) + $item->totalCost);
				}
			
                //add print parameter to session
                $_SESSION['items'] = $items;
                $_SESSION['grandTotalCost'] = $grandTotalCost;
				 $_SESSION['grandTotalCostForwad1'] = $grandTotalCostForwad1;
				$_SESSION['grandTotalCostForwad2'] = $grandTotalCostForwad2;

                //Layout
                $view = View::make('reports/zoneForm3cView',['years'=>$years,'units'=>$units,'unit'=>$unit]);
                $view->nest('reports_view','reports.htmlViews.zoneForm3cHtml',['items'=>$items, 
				'unit'=>$unit,'financialYear'=>$financialYear, 
				'grandTotalCost' => $grandTotalCost,
				'forward_et1' => $forward_et1,
				'forward_et2' => $forward_et2,
				'grandTotalCostForwad1' => $grandTotalCostForwad1,
				'grandTotalCostForwad2' => $grandTotalCostForwad2
				
				]);
				$view->nest('export_buttons','reports.includes.zone-form3c-header-button',['items'=>$items]);
                return $view;

          

        }else{

            return Redirect::back()
                ->withInput()
                ->withErrors($valid);
        }

    }
	
	
	
    public function downloadHQForm3c(){
       // session_start();

        if(isset($_SESSION['unit']) && isset($_SESSION['financialYear']) || isset($_SESSION['items'])){

            $parameter['unit'] =  $_SESSION['unit'] ;
            $parameter['financialYear'] = $_SESSION['financialYear'] ;
            $parameter['items'] =  $_SESSION['items'];
            $parameter['grandTotalCost'] =  $_SESSION['grandTotalCost'];
            $parameter['forward_et1'] =  $_SESSION['forward_et1'];
            $parameter['forward_et2'] =  $_SESSION['forward_et2'];
            $parameter['grandTotalCostForwad1'] =  $_SESSION['grandTotalCostForwad1'];
            $parameter['grandTotalCostForwad2'] =  $_SESSION['grandTotalCostForwad2'];


            $headers = array(
                "Content-type"=>"application/ms-excel",
                "Content-Disposition"=>"attachment;Filename=HQ_form3c.xls"
            );
            $content = View::make('reports/htmlViews/zoneForm3cHtml',$parameter);
            return Response::make($content,200, $headers);

        }else{
            return Redirect::back();
        }

    }
	
	//end HQ form3c
	
	
	
	
	
	
	

}
//session_destroy();