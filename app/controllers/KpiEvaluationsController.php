<?php

class KpiEvaluationsController extends \BaseController {
	
	
	protected $kpiControl;
	protected $unit;


    public function __construct(KpiControl $kpiControl,Unit $unit){
        parent::__construct();
        $this->kpiControl = $kpiControl;
        $this->unit = $unit;
    }

	
     public function getSubmitted(){
         $financial_year = FinancialYear::where('status','=',1)->first();
		 $unit = $this->unit->getUnit(Auth::user()->unit_id);
		 $zoneUnits = Unit::where('zone_id','=',$unit->zone_id)->where('deleted','=',0)->get();
	
		 $unitsSubmitted = $this->kpiControl->zoneUnitsSubmitted($unit->zone_id,$financial_year->id);
		 $submitted_report = $this->kpiControl->submitted_report($financial_year->id,$unit->id);
		 $submitted_quarters = $this->kpiControl->submitted_quarters($financial_year->id,$unit->id);
		 		 
		 $no_pending_quarter = 0;
		 
		//Layout
	
        $view = View::make('kpi_evaluation/submitted',compact('financial_year','unit','unit_submited','submitted_report','no_pending_quarter','submitted_quarters'));
		$view->nest('kpi_submit_view','kpi_evaluation.kpi_control',
			[
				'financial_year'=>$financial_year,
				'unit'=>$unit,
				'zoneUnits'=>$zoneUnits,
				'unitsSubmitted'=>$unitsSubmitted
			]);
		return $view;
     }
	//submit unit budget
    public function postSubmitted(){
        $rules = [
            'year_id'=>'required',
            'quarter'=>'required',
        ];
        $valid = Validator::make(Input::all(),$rules);
        if($valid->passes()){
            if($this->kpiControl->is_submitted(Input::get('year_id'),Auth::user()->unit_id,Input::get('quarter'))){
                return Redirect::back()->with('warning', 'Budget already submitted');
            }else{
				$KpiSubmit = new KpiControl();
					$KpiSubmit->year_id = Input::get('year_id');
					$KpiSubmit->unit_id = Auth::user()->unit_id;
					$KpiSubmit->user_id = Auth::user()->id;
					$KpiSubmit->quarter = Input::get('quarter');
					$KpiSubmit->save();
					return Redirect::back()->with('success', 'Budget has been submitted');
				             
            }
        }else{
            return Redirect::back()->withInput()->withErrors($valid);
        }
    } 
	
	//Unlock Unit m&e report
    public function unlock($id){
        $report = KpiControl::find($id);
        $report->delete();
        return Redirect::back()->with('success', 'Report has been unlocked');
    }


	/**
	 * Show the form for creating a new kpi
	 *
	 * @return Response
	 */
	 public function create($id)
 	{
 		$kpi = Kpi::find($id);
		$financial_year = FinancialYear::where('status','=',true)->first();
		$user = Auth::user();
		$unit = Unit::find($user->unit_id);
		$submitted_quarters = $this->kpiControl->submitted_quarters($financial_year->id,$unit->id);
		
		// KPI data values per financial Year for a given Unit
		$results = KpiEvaluation::getKpiEvaluation($kpi->id,$unit->id,$financial_year->id)->get();
		
		
		// KPI Bar Graph data values per financial Year for every quarter for a given Unit
		
		$dbLabels = [];
		$IndexDataset = [];
		$colors = array("#257c2c","#65918f","#293a11","#36CAAB","#808080","#800000","#808000","#008080","#800080");
				
		for($r = 0; $r < count($results); $r++){
			$dbLabels[] = $results[$r]->quarter;

			$fields = $kpi->fields;
			for($i = 0; $i < count($fields); $i++){
						
				if($fields[$i]->field->data_type == "integer"){
						$IndexDataset[$i]['label'] = $fields[$i]->field->label;
						$IndexDataset[$i]['backgroundColor'] = $colors[$i];
						$IndexDataset[$i]['data'][$r] = $results[$r][$fields[$i]->field->name];
				}									
			}
		}
		
		$labels = array_unique($dbLabels);//get unique labels
		$dataset =array_values($IndexDataset);	//remove index from array			

 		return View::make('kpi_evaluation.create',compact('kpi','results','labels','dataset','submitted_quarters'));
 	}

	/**
	 * Store a newly created kpi in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		
		$kpi = Kpi::find(Input::get('kpi_id'));
		
			$fields = $kpi->fields;
			$rules = [];
			for($i = 0; $i < count($fields); $i++){
				$rules[$fields[$i]->field->name] = $fields[$i]->field->validation_rule; //get all fields validation rules
							
			}
							
		$validator = Validator::make($data = Input::all(),$rules);

		$financial_year = FinancialYear::where('status','=',true)->first();
		$user = Auth::user();
		$unit = Unit::find($user->unit_id);

		if ($validator->passes())
		{
			 if($this->kpiControl->is_submitted(Input::get('year_id'),Auth::user()->unit_id,Input::get('quarter'))){
                return Redirect::back()->with('warning', 'Selected quarter evaluation already submitted');
            }else{
					$data['year_id'] = $financial_year->id;
					$data['unit_id'] = $unit->id;
					$data['zone_id'] = $unit->zone_id;
					$data['user_id'] = $user->id;
					KpiEvaluation::create($data);

			return Redirect::back()->with('success', 'Data has been Added');
			}
			
		}else{
			return Redirect::back()->withInput($data)->withErrors($validator);
		}
		 

	

	}
	

	/**
	 * Remove the specified kpi from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		KpiEvaluation::destroy($id);

		return Redirect::back()->with('success', 'Data has been Deleted');
	}
	
	//KPI unit reports
	
	 public function getUnitReport($id)
 	{
 		$kpi = Kpi::find($id);
		$years = FinancialYear::all();
		$unit = Unit::find(Auth::user()->unit_id);
		$units = Unit::where('zone_id','=',$unit->zone_id)->where('deleted','=',0)->get();
		$financial_year = FinancialYear::where('status','=',true)->first();		
		
		$results = KpiEvaluation::getKpiEvaluation($kpi->id,$unit->id,$financial_year->id);
	
						
			$fields = $kpi->fields;
			$fieldNames = [];
			$fieldsToSum = [];
			for($i = 0; $i < count($fields); $i++){
				$fieldNames[$i] = $fields[$i]->field->name; //get all table  fields 
				if($fields[$i]->field->data_type == 'integer'){
						$fieldsToSum[$i] = DB::raw('sum('.$fields[$i]->field->name.') as '.$fields[$i]->field->name);
				}			
			}	
			
		//check if field is dropdown, and group the results by dropdown fields	
			foreach($fields as $field){
						if($field->field->data_type == 'enum'){
							$results = $results->select('*',DB::raw(implode(',',$fieldsToSum)))->groupBy($field->field->name);	
						}
					}
					
		//Filter selected Fields	
			foreach($fieldNames as $name) {
				
				if (in_array($name,array_keys(Input::all()))){
					$results = $results->where($name,'=',Input::get($name));			
				} 				
			}
			
			
		$results = $results->get();
						
		//KPI Bar Graph data values per financial Year for every quarter for a given Unit
		
		$dbLabels = [];
		$titles = [];
		$BarChatDataset = [];
		$LineChatDataset = [];
		$bgcolors = array("#257c2c","#65918f","#293a11","#36CAAB","#808080","#800000","#808000","#008080","#800080");
		$bdcolors = array("rgba(255, 99, 132, 0.2)","rgba(54, 162, 235, 0.2)","rgba(255, 206, 86, 0.2)","rgba(75, 192, 192, 0.2)","rgba(255,99,132,1)","rgba(54, 162, 235, 1)","rgba(255, 206, 86, 1)","rgba(75, 192, 192, 1)","rgba(75, 192, 180, 1)");
				
		for($r = 0; $r < count($results); $r++){
			//$dbLabels[] = $results[$r]->quarter;
			$fields = $kpi->fields;
			for($i = 0; $i < count($fields); $i++){
				$fieldname = $fields[$i]->field->name;
			
				if($fields[$i]->field->data_type == "enum"){
				$titles[$i] = $fields[$i]->field->label;
				$dbLabels[$i]['labels'][$r] =$results[$r]->$fieldname;
				}
						
				if($fields[$i]->field->data_type == "integer"){
						$BarChatDataset[$i]['label'] = $fields[$i]->field->label;
						$BarChatDataset[$i]['backgroundColor'] = $bgcolors[$i];		
						$BarChatDataset[$i]['data'][$r] = $results[$r][$fields[$i]->field->name];
						
						$LineChatDataset[$i]['label'] = $fields[$i]->field->label;
						$LineChatDataset[$i]['backgroundColor'] = $bgcolors[$i];
						$LineChatDataset[$i]['borderColor'] = $bdcolors[$i];
						$LineChatDataset[$i]['pointBorderColor'] = $bgcolors[$i];
						$LineChatDataset[$i]['pointBackgroundColor'] = $bdcolors[$i];
						$LineChatDataset[$i]['pointHoverBackgroundColor'] = $bgcolors[$i];
						$LineChatDataset[$i]['pointHoverBorderColor'] = $bdcolors[$i];
						$LineChatDataset[$i]['pointBorderWidth'] = 1;
						$LineChatDataset[$i]['data'][$r] = $results[$r][$fields[$i]->field->name];
				}									
			}
		}
		
		//return var_dump($titles);
		//$labels = array_values(array_unique($dbLabels));//get unique labels
		$dataset =array_values($BarChatDataset);	//remove index from array
		$linedataset =array_values($LineChatDataset);		
		
					
		$view  = View::make('kpi_evaluation.unitReport',['kpi'=>$kpi,'results'=>$results,'years'=>$years,'unit'=>$unit,'units'=>$units,'financial_year'=>$financial_year]);
			
		$view->nest('Charts','kpi_evaluation.Charts',['titles'=>$titles,'dbLabels'=>$dbLabels,'dataset'=>$dataset,'linedataset'=>$linedataset]);
		
						
						
		return $view;
		
 	
 	}
	
	 public function postUnitReport($id)
 	{
		
		 $rules = [
            'year' =>'required',
        ];

        $valid = Validator::make($data = Input::all(), $rules);

        if ($valid->passes()) {
			
		$years = FinancialYear::all();
		$financial_year = FinancialYear::find(Input::get('year'));
		$unit = Unit::find(Auth::user()->unit_id);
		
		if(isset($data['unit'])){
				$unit = Unit::find($data['unit']);
			}
		$units = Unit::where('zone_id','=',$unit->zone_id)->where('deleted','=',0)->get();
		$kpi = Kpi::find($id);
		$charts = Input::get('chart');
		
		// KPI data values per financial Year for a given Unit
		
		$results = KpiEvaluation::getKpiEvaluation($kpi->id,$unit->id,$financial_year->id);
	
						
			$fields = $kpi->fields;
			$fieldNames = [];
			$fieldsToSum = [];
			for($i = 0; $i < count($fields); $i++){
				$fieldNames[$i] = $fields[$i]->field->name; //get all table  fields 
				if($fields[$i]->field->data_type == 'integer'){
						$fieldsToSum[$i] = DB::raw('sum('.$fields[$i]->field->name.') as '.$fields[$i]->field->name);
				}			
			}	
			
		//check if field is dropdown, and group the results by dropdown fields	
			foreach($fields as $field){
						if($field->field->data_type == 'enum'){
							$results = $results->select('*',DB::raw(implode(',',$fieldsToSum)))->groupBy($field->field->name);	
						}
					}
					
		//Filter selected Fields	
			foreach($fieldNames as $name) {
				
				if (in_array($name,array_keys(Input::all()))){
					$results = $results->where($name,'=',Input::get($name));			
				} 				
			}
			
			
		$results = $results->get();
						
		//KPI Bar Graph data values per financial Year for every quarter for a given Unit
		
		$dbLabels = [];
		$titles = [];
		$BarChatDataset = [];
		$LineChatDataset = [];
		$bgcolors = array("#257c2c","#65918f","#293a11","#36CAAB","#808080","#800000","#808000","#008080","#800080");
		$bdcolors = array("rgba(255, 99, 132, 0.2)","rgba(54, 162, 235, 0.2)","rgba(255, 206, 86, 0.2)","rgba(75, 192, 192, 0.2)","rgba(255,99,132,1)","rgba(54, 162, 235, 1)","rgba(255, 206, 86, 1)","rgba(75, 192, 192, 1)","rgba(75, 192, 180, 1)");
				
		for($r = 0; $r < count($results); $r++){
			$fields = $kpi->fields;
			
			for($i = 0; $i < count($fields); $i++){
				$fieldname = $fields[$i]->field->name;
			
				if($fields[$i]->field->data_type == "enum"){
				$titles[$i] = $fields[$i]->field->label;
				$dbLabels[$i]['labels'][$r] =$results[$r]->$fieldname;
				}
						
				if($fields[$i]->field->data_type == "integer"){
						$BarChatDataset[$i]['label'] = $fields[$i]->field->label;
						$BarChatDataset[$i]['backgroundColor'] = $bgcolors[$i];		
						$BarChatDataset[$i]['data'][$r] = $results[$r][$fields[$i]->field->name];
						
						$LineChatDataset[$i]['label'] = $fields[$i]->field->label;
						$LineChatDataset[$i]['backgroundColor'] = $bgcolors[$i];
						$LineChatDataset[$i]['borderColor'] = $bdcolors[$i];
						$LineChatDataset[$i]['pointBorderColor'] = $bgcolors[$i];
						$LineChatDataset[$i]['pointBackgroundColor'] = $bdcolors[$i];
						$LineChatDataset[$i]['pointHoverBackgroundColor'] = $bgcolors[$i];
						$LineChatDataset[$i]['pointHoverBorderColor'] = $bdcolors[$i];
						$LineChatDataset[$i]['pointBorderWidth'] = 1;
						$LineChatDataset[$i]['data'][$r] = $results[$r][$fields[$i]->field->name];
				}									
			}
		}
		
		//$labels = array_values(array_unique($dbLabels));//get unique labels
		$dataset =array_values($BarChatDataset);	//remove index from array
		$linedataset =array_values($LineChatDataset);	
		
					
		$view  = View::make('kpi_evaluation.unitReport',['kpi'=>$kpi,'results'=>$results,'years'=>$years,'unit'=>$unit,'units'=>$units,'financial_year'=>$financial_year]);
			
	$view->nest('Charts','kpi_evaluation.Charts',['titles'=>$titles,'dbLabels'=>$dbLabels,'dataset'=>$dataset,'linedataset'=>$linedataset]);
														
		return $view;
		
		}else{

            return Redirect::back()
                ->withInput()
                ->withErrors($valid);
        }		
	}

  // KPI zone Report

	 public function getZoneReport($id)
 	{
 		$kpi = Kpi::find($id);
		$years = FinancialYear::all();
		$unit = Unit::find(Auth::user()->unit_id);
		$zone = Zone::find($unit->zone_id);	
		$zones = Zone::where('deleted','=',0)->get();
		$financial_year = FinancialYear::where('status','=',true)->first();	
		
		// KPI data values per financial Year for a given Unit
		
		$results = KpiEvaluation::getZoneKpiEvaluation($kpi->id,$zone->id,$financial_year->id);
					
			$fields = $kpi->fields;
			$fieldNames = [];
			$fieldsToSum = [];
			for($i = 0; $i < count($fields); $i++){
				$fieldNames[$i] = $fields[$i]->field->name; //get all table  fields 
				if($fields[$i]->field->data_type == 'integer'){
						$fieldsToSum[$i] = DB::raw('sum('.$fields[$i]->field->name.') as '.$fields[$i]->field->name);
				}			
			}	
			
		//check if field is dropdown, and group the results by dropdown fields	
			foreach($fields as $field){
						if($field->field->data_type == 'enum'){
							$results = $results->select('*',DB::raw(implode(',',$fieldsToSum)))->groupBy($field->field->name);	
						}
					}
					
		//Filter selected Fields	
			foreach($fieldNames as $name) {
				
				if (in_array($name,array_keys(Input::all()))){
					$results = $results->where($name,'=',Input::get($name));			
				} 				
			}
			
			
		$results = $results->get();
						
		//KPI Bar Graph data values per financial Year for every quarter for a given Unit
		
		$dbLabels = [];
		$titles = []; 
		$BarChatDataset = [];
		$LineChatDataset = [];
		$bgcolors = array("#257c2c","#65918f","#293a11","#36CAAB","#808080","#800000","#808000","#008080","#800080");
		$bdcolors = array("rgba(255, 99, 132, 0.2)","rgba(54, 162, 235, 0.2)","rgba(255, 206, 86, 0.2)","rgba(75, 192, 192, 0.2)","rgba(255,99,132,1)","rgba(54, 162, 235, 1)","rgba(255, 206, 86, 1)","rgba(75, 192, 192, 1)","rgba(75, 192, 180, 1)");
				
		for($r = 0; $r < count($results); $r++){

			$fields = $kpi->fields;
			for($i = 0; $i < count($fields); $i++){
				
				$fieldname = $fields[$i]->field->name;
			
				if($fields[$i]->field->data_type == "enum"){
				$titles[$i] = $fields[$i]->field->label;
				$dbLabels[$i]['labels'][$r] =$results[$r]->$fieldname;
				}
						
				if($fields[$i]->field->data_type == "integer"){
						$BarChatDataset[$i]['label'] = $fields[$i]->field->label;
						$BarChatDataset[$i]['backgroundColor'] = $bgcolors[$i];		
						$BarChatDataset[$i]['data'][$r] = $results[$r][$fields[$i]->field->name];
						
						$LineChatDataset[$i]['label'] = $fields[$i]->field->label;
						$LineChatDataset[$i]['backgroundColor'] = $bdcolors[$i];
						$LineChatDataset[$i]['borderColor'] = $bdcolors[$i];
						$LineChatDataset[$i]['pointBorderColor'] = $bgcolors[$i];
						$LineChatDataset[$i]['pointBackgroundColor'] = $bdcolors[$i];
						$LineChatDataset[$i]['pointHoverBackgroundColor'] = $bgcolors[$i];
						$LineChatDataset[$i]['pointHoverBorderColor'] = $bdcolors[$i];
						$LineChatDataset[$i]['pointBorderWidth'] = 1;
						$LineChatDataset[$i]['data'][$r] = $results[$r][$fields[$i]->field->name];
				}									
			}
		}
		
		//$labels = array_values(array_unique($dbLabels));//get unique labels
		$dataset =array_values($BarChatDataset);	//remove index from array
		$linedataset =array_values($LineChatDataset);		
		
					
		$view  = View::make('kpi_evaluation.zoneReport',['kpi'=>$kpi,'results'=>$results,'years'=>$years,'zone'=>$zone,'zones'=>$zones,'financial_year'=>$financial_year]);
			
		$view->nest('Charts','kpi_evaluation.Charts',['titles'=>$titles,'dbLabels'=>$dbLabels,'dataset'=>$dataset,'linedataset'=>$linedataset]);
		
								
		return $view;
 	
 	}
	
	 public function postZoneReport($id)
 	{
		
		 $rules = [
            'year' =>'required',
        ];

        $valid = Validator::make($data = Input::all(), $rules);

        if ($valid->passes()) {
			
		$years = FinancialYear::all();
		$financial_year = FinancialYear::find(Input::get('year'));
		$unit = Unit::find(Auth::user()->unit_id);
		$zone = Zone::find($unit->zone_id);	
			
		if(isset($data['zone'])){
				$zone = Zone::find($data['zone']);
			}
			
		$zones = Zone::where('deleted','=',0)->get();
		$kpi = Kpi::find($id);
		$charts = Input::get('chart');
		
		// KPI data values per financial Year for a given Unit
		
		$results = KpiEvaluation::getZoneKpiEvaluation($kpi->id,$zone->id,$financial_year->id);

					$fields = $kpi->fields;
			$fieldNames = [];
			$fieldsToSum = [];
			for($i = 0; $i < count($fields); $i++){
				$fieldNames[$i] = $fields[$i]->field->name; //get all table  fields 
				if($fields[$i]->field->data_type == 'integer'){
						$fieldsToSum[$i] = DB::raw('sum('.$fields[$i]->field->name.') as '.$fields[$i]->field->name);
				}			
			}	
			
		//check if field is dropdown, and group the results by dropdown fields	
			foreach($fields as $field){
						if($field->field->data_type == 'enum'){
							$results = $results->select('*',DB::raw(implode(',',$fieldsToSum)))->groupBy($field->field->name);	
						}
					}
					
		//Filter selected Fields	
			foreach($fieldNames as $name) {
				
				if (in_array($name,array_keys(Input::all()))){
					$results = $results->where($name,'=',Input::get($name));			
				} 				
			}
			
			
		$results = $results->get();
						
		//KPI Bar Graph data values per financial Year for every quarter for a given Unit
		
		$dbLabels = [];
		$titles = [];
		$BarChatDataset = [];
		$LineChatDataset = [];
		$bgcolors = array("#257c2c","#65918f","#293a11","#36CAAB","#808080","#800000","#808000","#008080","#800080");
		$bdcolors = array("rgba(255, 99, 132, 0.2)","rgba(54, 162, 235, 0.2)","rgba(255, 206, 86, 0.2)","rgba(75, 192, 192, 0.2)","rgba(255,99,132,1)","rgba(54, 162, 235, 1)","rgba(255, 206, 86, 1)","rgba(75, 192, 192, 1)","rgba(75, 192, 180, 1)");
				
		for($r = 0; $r < count($results); $r++){

			$fields = $kpi->fields;
			for($i = 0; $i < count($fields); $i++){
				
				$fieldname = $fields[$i]->field->name;
			
				if($fields[$i]->field->data_type == "enum"){
				$titles[$i] = $fields[$i]->field->label;
				$dbLabels[$i]['labels'][$r] =$results[$r]->$fieldname;
				}
						
				if($fields[$i]->field->data_type == "integer"){
						$BarChatDataset[$i]['label'] = $fields[$i]->field->label;
						$BarChatDataset[$i]['backgroundColor'] = $bgcolors[$i];		
						$BarChatDataset[$i]['data'][$r] = $results[$r][$fields[$i]->field->name];
						
						$LineChatDataset[$i]['label'] = $fields[$i]->field->label;
						$LineChatDataset[$i]['backgroundColor'] = $bgcolors[$i];
						$LineChatDataset[$i]['borderColor'] = $bdcolors[$i];
						$LineChatDataset[$i]['pointBorderColor'] = $bgcolors[$i];
						$LineChatDataset[$i]['pointBackgroundColor'] = $bdcolors[$i];
						$LineChatDataset[$i]['pointHoverBackgroundColor'] = $bgcolors[$i];
						$LineChatDataset[$i]['pointHoverBorderColor'] = $bdcolors[$i];
						$LineChatDataset[$i]['pointBorderWidth'] = 1;
						$LineChatDataset[$i]['data'][$r] = $results[$r][$fields[$i]->field->name];
				}									
			}
		}
		
		//$labels = array_values(array_unique($dbLabels));//get unique labels
		$dataset =array_values($BarChatDataset);	//remove index from array
		$linedataset =array_values($LineChatDataset);		
		
					
		$view  = View::make('kpi_evaluation.zoneReport',['kpi'=>$kpi,'results'=>$results,'years'=>$years,'zone'=>$zone,'zones'=>$zones,'financial_year'=>$financial_year]);
			
			$view->nest('Charts','kpi_evaluation.Charts',['titles'=>$titles,'dbLabels'=>$dbLabels,'dataset'=>$dataset,'linedataset'=>$linedataset]);
		
			
								
		
		return $view;
		
		}else{

            return Redirect::back()
                ->withInput()
                ->withErrors($valid);
        }		
	}
	
	
	 // KPI Over all TFS Report

	public function getOverallReport($id)
 	{
 		$kpi = Kpi::find($id);
		$years = FinancialYear::all();		
		$financial_year = FinancialYear::where('status','=',true)->first();	
		
			// KPI data values per financial Year for a given Unit
		
		$results = KpiEvaluation::getOverallKpiEvaluation($kpi->id,$financial_year->id);
		
		$fields = $kpi->fields;
			$fieldNames = [];
			$fieldsToSum = [];
			for($i = 0; $i < count($fields); $i++){
				$fieldNames[$i] = $fields[$i]->field->name; //get all table  fields 
				if($fields[$i]->field->data_type == 'integer'){
						$fieldsToSum[$i] = DB::raw('sum('.$fields[$i]->field->name.') as '.$fields[$i]->field->name);
				}			
			}	
			
		//check if field is dropdown, and group the results by dropdown fields	
			foreach($fields as $field){
						if($field->field->data_type == 'enum'){
							$results = $results->select('*',DB::raw(implode(',',$fieldsToSum)))->groupBy($field->field->name);	
						}
					}
					
		//Filter selected Fields	
			foreach($fieldNames as $name) {
				
				if (in_array($name,array_keys(Input::all()))){
					$results = $results->where($name,'=',Input::get($name));			
				} 				
			}
			
			
		$results = $results->get();
						
		//KPI Bar Graph data values per financial Year for every quarter for a given Unit
		
		$dbLabels = [];
		$titles = [];
		$BarChatDataset = [];
		$LineChatDataset = [];
		$bgcolors = array("#257c2c","#65918f","#293a11","#36CAAB","#808080","#800000","#808000","#008080","#800080");
		$bdcolors = array("rgba(255, 99, 132, 0.2)","rgba(54, 162, 235, 0.2)","rgba(255, 206, 86, 0.2)","rgba(75, 192, 192, 0.2)","rgba(255,99,132,1)","rgba(54, 162, 235, 1)","rgba(255, 206, 86, 1)","rgba(75, 192, 192, 1)","rgba(75, 192, 180, 1)");
				
		for($r = 0; $r < count($results); $r++){

			$fields = $kpi->fields;
			for($i = 0; $i < count($fields); $i++){
				
				$fieldname = $fields[$i]->field->name;
			
				if($fields[$i]->field->data_type == "enum"){
				$titles[$i] = $fields[$i]->field->label;
				$dbLabels[$i]['labels'][$r] =$results[$r]->$fieldname;
				}
						
				if($fields[$i]->field->data_type == "integer"){
						$BarChatDataset[$i]['label'] = $fields[$i]->field->label;
						$BarChatDataset[$i]['backgroundColor'] = $bgcolors[$i];		
						$BarChatDataset[$i]['data'][$r] = $results[$r][$fields[$i]->field->name];
						
						$LineChatDataset[$i]['label'] = $fields[$i]->field->label;
						$LineChatDataset[$i]['backgroundColor'] = $bgcolors[$i];
						$LineChatDataset[$i]['borderColor'] = $bdcolors[$i];
						$LineChatDataset[$i]['pointBorderColor'] = $bgcolors[$i];
						$LineChatDataset[$i]['pointBackgroundColor'] = $bdcolors[$i];
						$LineChatDataset[$i]['pointHoverBackgroundColor'] = $bgcolors[$i];
						$LineChatDataset[$i]['pointHoverBorderColor'] = $bdcolors[$i];
						$LineChatDataset[$i]['pointBorderWidth'] = 1;
						$LineChatDataset[$i]['data'][$r] = $results[$r][$fields[$i]->field->name];
				}									
			}
		}
		
		//$labels = array_values(array_unique($dbLabels));//get unique labels
		$dataset =array_values($BarChatDataset);	//remove index from array
		$linedataset =array_values($LineChatDataset);		
		
					
		$view  = View::make('kpi_evaluation.overallReport',['kpi'=>$kpi,'results'=>$results,'years'=>$years,'financial_year'=>$financial_year]);
			
		$view->nest('Charts','kpi_evaluation.Charts',['titles'=>$titles,'dbLabels'=>$dbLabels,'dataset'=>$dataset,'linedataset'=>$linedataset]);
										
		return $view;
 	
 	}
	
	public function postOverallReport($id)
 	{
		
		 $rules = [
            'year' =>'required',
        ];

        $valid = Validator::make($data = Input::all(), $rules);

        if ($valid->passes()) {
			
		$years = FinancialYear::all();
		$financial_year = FinancialYear::find(Input::get('year'));	
	
		$kpi = Kpi::find($id);
		$charts = Input::get('chart');
										
			
		// KPI data values per financial Year for a given Unit
		
		$results = KpiEvaluation::getOverallKpiEvaluation($kpi->id,$financial_year->id);

		$fields = $kpi->fields;
			$fieldNames = [];
			$fieldsToSum = [];
			for($i = 0; $i < count($fields); $i++){
				$fieldNames[$i] = $fields[$i]->field->name; //get all table  fields 
				if($fields[$i]->field->data_type == 'integer'){
						$fieldsToSum[$i] = DB::raw('sum('.$fields[$i]->field->name.') as '.$fields[$i]->field->name);
				}			
			}	
			
		//check if field is dropdown, and group the results by dropdown fields	
			foreach($fields as $field){
						if($field->field->data_type == 'enum'){
							$results = $results->select('*',DB::raw(implode(',',$fieldsToSum)))->groupBy($field->field->name);	
						}
					}
					
		//Filter selected Fields	
			foreach($fieldNames as $name) {
				
				if (in_array($name,array_keys(Input::all()))){
					$results = $results->where($name,'=',Input::get($name));			
				} 				
			}
			
			
		$results = $results->get();
						
		//KPI Bar Graph data values per financial Year for every quarter for a given Unit
		
		$dbLabels = [];
		$titles = [];
		$BarChatDataset = [];
		$LineChatDataset = [];
		$bgcolors = array("#257c2c","#65918f","#293a11","#36CAAB","#808080","#800000","#808000","#008080","#800080");
		$bdcolors = array("rgba(255, 99, 132, 0.2)","rgba(54, 162, 235, 0.2)","rgba(255, 206, 86, 0.2)","rgba(75, 192, 192, 0.2)","rgba(255,99,132,1)","rgba(54, 162, 235, 1)","rgba(255, 206, 86, 1)","rgba(75, 192, 192, 1)","rgba(75, 192, 180, 1)");
				
		for($r = 0; $r < count($results); $r++){

			$fields = $kpi->fields;
			for($i = 0; $i < count($fields); $i++){
				
				$fieldname = $fields[$i]->field->name;
			
				if($fields[$i]->field->data_type == "enum"){
				$titles[$i] = $fields[$i]->field->label;
				$dbLabels[$i]['labels'][$r] =$results[$r]->$fieldname;
				}
						
				if($fields[$i]->field->data_type == "integer"){
						$BarChatDataset[$i]['label'] = $fields[$i]->field->label;
						$BarChatDataset[$i]['backgroundColor'] = $bgcolors[$i];		
						$BarChatDataset[$i]['data'][$r] = $results[$r][$fields[$i]->field->name];
						
						$LineChatDataset[$i]['label'] = $fields[$i]->field->label;
						$LineChatDataset[$i]['backgroundColor'] = $bgcolors[$i];
						$LineChatDataset[$i]['borderColor'] = $bdcolors[$i];
						$LineChatDataset[$i]['pointBorderColor'] = $bgcolors[$i];
						$LineChatDataset[$i]['pointBackgroundColor'] = $bdcolors[$i];
						$LineChatDataset[$i]['pointHoverBackgroundColor'] = $bgcolors[$i];
						$LineChatDataset[$i]['pointHoverBorderColor'] = $bdcolors[$i];
						$LineChatDataset[$i]['pointBorderWidth'] = 1;
						$LineChatDataset[$i]['data'][$r] = $results[$r][$fields[$i]->field->name];
				}									
			}
		}
		
		//$labels = array_values(array_unique($dbLabels));//get unique labels
		$dataset =array_values($BarChatDataset);	//remove index from array
		$linedataset =array_values($LineChatDataset);		
		
					
		$view  = View::make('kpi_evaluation.overallReport',['kpi'=>$kpi,'results'=>$results,'years'=>$years,'financial_year'=>$financial_year]);
			
		$view->nest('Charts','kpi_evaluation.Charts',['titles'=>$titles,'dbLabels'=>$dbLabels,'dataset'=>$dataset,'linedataset'=>$linedataset]);
										
		return $view;
		
		}else{

            return Redirect::back()
                ->withInput()
                ->withErrors($valid);
        }		
	}

}
