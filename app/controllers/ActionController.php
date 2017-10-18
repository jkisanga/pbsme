<?php

class ActionController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    protected $year;
    protected  $objective;
    protected $target;
    protected  $activity;
    protected $item;
    protected $unit;
    protected $submission;
    protected $unitControl;
    protected $zoneControl;

    public function __construct(
        FinancialYear $year,
        Objective $objective, Target $target,
        Activity $activity,Item $item,
        Unit $unit,
        Submission $submission,
        UnitControl $unitControl,
        ZoneControl $zoneControl
    ){

        parent::__construct();
        $this->year = $year;
        $this->objective = $objective;
        $this->target = $target;
        $this->activity = $activity;
        $this->item = $item;
        $this->unit = $unit;
        $this->submission = $submission;
        $this->unitControl = $unitControl;
        $this->zoneControl = $zoneControl;
    }
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function addObjective()
	{
        $codes = RefObjectiveCode::all();
        return View::make('action/add_objective', compact('codes'));
	}

    public function storeObjective(){

        $rules = [
            'ob_code'=>'required',
            'ob_description'=>'required'
        ];

        $valid = Validator::make(Input::all(),$rules);
        $code_exist = Objective::where('ob_code','=',Input::get('ob_code'))->first();

        if($valid->passes()){
            if(count($code_exist) > 0) {
                return Redirect::back()->with('error','objective code exists');
            }else{
                $rand_no = rand(20000, 100000000);
                $input = new Objective();
                $input->ob_code = Input::get('ob_code');
                $input->ob_description = Input::get('ob_description');
                $input->rand_no = $rand_no;
                $input->save();
            }
            return Redirect::to('add_objective')->with('success', Lang::get('admin/action/messages.create.success'));
        }else{
            return Redirect::back()->withInput()->withErrors($valid);
        }
    }

    public function editObjective($id){
        $objective = $this->objective->find($id);
        $codes = RefObjectiveCode::all();
        return View::make('action/add_objective', compact('objective','codes'));
    }

    public function updateObjective($id){
        $rules = [
            'ob_code'=>'required',
            'ob_description'=>'required'
        ];

        $valid = Validator::make(Input::all(),$rules);

        if($valid->passes()){


                $input = $this->objective->find($id);
                $input->ob_code = Input::get('ob_code');
                $input->ob_description = Input::get('ob_description');
                $input->save();

            return Redirect::to('list_objective')->with('success', Lang::get('admin/action/messages.update.success'));
        }else{
            return Redirect::back()->withInput()->withErrors($valid);
        }
    }
    public function listObjectiveForTarget(){
        $list_objective = $this->objective->get();
        return View::make('action/list_objective_for_target', compact('list_objective'));
    }

	public function addTarget($id)
	{
        $objective = $this->objective->where('id', '=', $id)->orderby('ob_code')->first();
        $targets = $this->target->where('objective_id', '=', $id)->get();
        $targetTypes = RefTargetNo::orderBy('name','ASC')->get();
		return View::make('action/add_target', compact('targets','objective','targetTypes'));
	}

    public function storeTarget(){
        $rules = [
            'target_no'=>'required',
            'target_type'=>'required',
            'ta_description'=>'required',
        ];

        $valid = Validator::make(Input::all(),$rules);
        $target_exist =Target::where('target_no','=',Input::get('target_no'))
            ->where('objective_id','=',Input::get('objective_id'))->first();

        if($valid->passes()){
            if(count($target_exist) > 0){
                return Redirect::back()->with('error','The target number already exists!');
            }else{
                $input = new Target();
                $input->ta_description = Input::get('ta_description');
                $input->target_no = Input::get('target_no');
                $input->target_type = Input::get('target_type');
                $input->objective_id = Input::get('objective_id');
                $input->save();

                return Redirect::back()->with('success','Target Added successfully');
            }

        }else{
            return Redirect::back()->withInput()->withErrors($valid);
        }

    }

    public function editTarget($id)
    {
        $target = $this->target->find($id);
        $targetTypes = RefTargetNo::orderBy('name','ASC')->get();
        return View::make('action/edit_target', compact('target','targetTypes'));
    }

    public function updateTarget($id){
        $rules = [
            'target_no'=>'required',
            'target_type'=>'required',
            'ta_description'=>'required',
        ];

        $valid = Validator::make(Input::all(),$rules);

        $target_exist =Target::where('target_no','=',Input::get('target_no'))
            ->where('objective_id','=',Input::get('objective_id'))->first();


        if($valid->passes()){
                $target = $this->target->find($id);
                $target->ta_description = Input::get('ta_description');
                $target->target_no = Input::get('target_no');
                $target->target_type = Input::get('target_type');
                $target->objective_id = Input::get('objective_id');
                $target->save();
            return Redirect::to('add_target/'.$target->objective_id)->with('success','Target Added successfully');

        }else{
            return Redirect::back()->withInput()->withErrors($valid);
        }
    }

    public function addActivity($id){

        $financial_year = FinancialYear::where('status','=',true)->first();
        if(isset($financial_year)) {
            $target = $this->target->find($id);

            $activities = $this->activity
                ->where('target_id', '=', $id)
                ->where('year_id', '=', $financial_year->id)
                ->where('unit_id', '=', Auth::user()->unit_id)
                ->orderBy('activity_no','ASC')->get();

            $obj = $this->objective->where('id', '=', $target->objective_id)->first();

            $total = Activity::where('year_id', '=', $financial_year->id)
                ->where('target_id', '=', $id)
                ->where('unit_id', '=', Auth::user()->unit_id)
                ->orderBy('activity_no')->count();

            $activity_no = null;
            if($total > 0){
                //$activity_no = $obj->ob_code . $target->target_no . $target->target_type . ($total + 1);
                $activity_no = $obj->ob_code . sprintf('%02d', $target->target_no) . $target->target_type . (sprintf('%02d', $total + 1));
				
            }else{
                $activity_no = $obj->ob_code . sprintf('%02d', $target->target_no) . $target->target_type . (sprintf('%02d',1));
            }

            return View::make('action/add_activity', compact('financial_year','target', 'activities', 'activity_no', 'obj'));
        }else{
            return Redirect::back()->with('error', 'No active financial year, contact system administrator');
        }
    }

	public function storeActivity()
	{
        $rules = [
            'activity_no'=>'required',
            'a_description'=>'required',
            'type'=>'required',
        ];

        $user = Auth::user();
        $unit = Unit::find($user->unit_id);

        $valid = Validator::make(Input::all(),$rules);

        if($valid->passes()){
            $targetNo = Input::get('target_id');

            $input = new Activity();
            $input->a_description = Input::get('a_description');
            $input->target_id = $targetNo;
            $input->activity_no = Input::get('activity_no');
            $input->year_id = Input::get('year_id');
            $input->unit_id = $user->unit_id;
            $input->type = Input::get('type');
            $input->zone_id = $unit->zone_id;
            $input->save();

            return Redirect::to('add_activity/'.$targetNo);
//                ->with('success', 'Activity added successful');
        }else{
            return Redirect::back()->withInput()->withErrors($valid);
        }
	}

    public function deleteActivity($id){
        $activity = Activity::find($id);
        if($activity->is_combined == false){
			$items = Item::where('activity_id','=',$activity->id)->get();
			foreach($items as $item){
				$item_delete = Item::find($item->id);
				$item_delete->delete();
			}
            $activity->delete();
            return Redirect::to('add_activity/'.$activity->target_id)->with('success','activity has been deleted');
        }else{
            return Redirect::back()->with('warning','Activity can not be delete, consolidation has been done');
        }

    }


    public function addItem($id){

        $activity = $this->activity->find($id);
        $unit_measures = RefUnitMeasure::orderBy('description')->get();
        $target = $this->target->where('id','=', $activity->target_id)->first();
        $objective = $this->objective->where('id','=', $target->objective_id)->first();
        $items = $this->item->where('activity_id','=', $id)->get();
        $total = $this->item->where('activity_id','=', $id)->sum('cost');

        return View::make('action/add_item', compact('activity','unit_measures','target','objective', 'items','total'));
    }

    public function storeItem(){
        $rules = [
            'item_code'=>'required',
            'no_of_unit'=>'required',
            'number_of_input'=>'required',
            'input_description'=>'required',
            'unit_cost'=>'required',
            'unit_of_measure'=>'required',
        ];

        $valid = Validator::make(Input::all(),$rules);

        $exist_item = $this->item->where('activity_id','=', Input::get('activity_id'))->where('item_code','=',Input::get('item_code'))->first();

        if($valid->passes()){
            if(count($exist_item) > 0){
                return Redirect::back()->with('error','Item already exist');
            }else{
                $activity_id = Input::get('activity_id');
                $cost = (Input::get('unit_cost'))*(Input::get('no_of_unit'))*(Input::get('number_of_input'));
                $total_unit = (Input::get('no_of_unit'))*(Input::get('number_of_input'));
				$financial_year = FinancialYear::where('status','=',true)->first();
				
                $input = new Item();
                $input->input_description = Input::get('input_description');
                $input->no_of_unit = Input::get('no_of_unit');
                $input->number_of_input = Input::get('number_of_input');
                $input->total_unit = $total_unit ;
                $input->item_code = Input::get('item_code');
                $input->unit_of_measure = Input::get('unit_of_measure');
                $input->activity_id = $activity_id;
                $input->cost = $cost;
                $input->unit_cost = Input::get('unit_cost');
                $input->forward_units1 = String::project_units($financial_year->projection_percentage, $input->total_unit );
                $input->forward_cost1 = String::project_cost($financial_year->projection_percentage, $input->total_unit,$input->unit_cost );
                $input->forward_units2 = String::project_units($financial_year->projection_percentage*2, $input->total_unit );
                $input->forward_cost2 = String::project_cost($financial_year->projection_percentage*2, $input->total_unit,$input->unit_cost );
				
                $input->save();
            }

            return Redirect::to('add_item/'.$activity_id );
        }else{
            return Redirect::back()->withInput()->withErrors($valid);
        }
    }

	/**
	 * Delete an Item
	 *
	 * @param  int  $id
	 */
	 
	 public function deleteItem($id){
		 $item = Item::find($id);
		 $item->delete();
		 return Redirect::back()->with('success','Item has been removed');
		 
	 }
	 
	 
	public function getEditActivity($id)
	{
		$activity = Activity::find($id);
        return View::make('action/edit_activity', compact('activity'));
	}

    //post edit activity
    public function postEditActivity($id){
        $rules = [
            'activity_no'=>'required',
            'a_description'=>'required',
            'type'=>'required',
        ];

        $user = Auth::user();
        $unit = Unit::find($user->unit_id);

        $valid = Validator::make(Input::all(),$rules);

        if($valid->passes()) {

            $targetId = Input::get('target_id');

            $input = Activity::find($id);
            $input->a_description = Input::get('a_description');
            $input->activity_no = Input::get('activity_no');
            $input->unit_id = $user->unit_id;
            $input->type = Input::get('type');
            $input->zone_id = $unit->zone_id;
            $input->save();

            return Redirect::to('add_activity/' . $targetId)
               ->with('success', 'Activity Updated successful');
        }else{
            return Redirect::back()->withInput()->withErrors($valid);
        }
    }

    public function getEditItem($id)
	{
		$data = Item::find($id);
        $activity = $this->activity->find($data->activity_id);
        $target = $this->target->where('id','=', $activity->target_id)->first();
        $objective = $this->objective->where('id','=', $target->objective_id)->first();
        $items = $this->item->where('activity_id','=', $data->activity_id)->get();
        $total = $this->item->where('activity_id','=', $id)->sum('cost');

       // echo $data->activity_id;
       return View::make('action/edit_item', compact('activity','target','objective', 'items','total','data'));
	}

    public function updateItem($id){
        $rules = [
            'item_code'=>'required',
            'no_of_unit'=>'required',
            'number_of_input'=>'required',
            'input_description'=>'required',
            'unit_cost'=>'required',
            'unit_of_measure'=>'required',
        ];

        $valid = Validator::make(Input::all(),$rules);

        if($valid->passes()) {
            $activity_id = Input::get('activity_id');
            $cost = (Input::get('unit_cost')) * (Input::get('no_of_unit')) *(Input::get('number_of_input'));
			$total_unit = (Input::get('no_of_unit'))*(Input::get('number_of_input'));
			 
            $input = Item::find($id);
            $input->input_description = Input::get('input_description');
            $input->no_of_unit = Input::get('no_of_unit');
			$input->total_unit = $total_unit ;
            $input->number_of_input = Input::get('number_of_input');
            $input->item_code = Input::get('item_code');
            $input->unit_of_measure = Input::get('unit_of_measure');
            $input->activity_id = $activity_id;
            $input->cost = $cost;
            $input->unit_cost = Input::get('unit_cost');
            $input->save();
            return Redirect::to('add_item/' . $activity_id)->with('success', 'Item update successful');
        }else{
				return Redirect::back()->withInput()->withErrors($valid);
		}
    }

	public function actionDashboard()
	{
        $year = FinancialYear::where('status','=',true)->first();
        $activities = $this->activity->getActivitiesByUnit(Auth::user()->unit_id,$year->id);  
		$unit = $this->unit->getUnit(Auth::user()->unit_id);
		$zones = Zone::where('deleted','=',false)->get();
        $submitted_budgets = $this->unitControl->submitted_budget($unit->zone_id);
		$pending_consolidation = ZonalActivity::zonal_pending_activities($year->id);
       // $submitted_zone_budgets = $this->zoneControl->submitted_zone_budget();
       
	

        //Layout
        $view = View::make('action.dashboard',['unit'=>$unit,'zones'=>$zones]);
        $view->nest('activities_view','action.partials.activities',['activities'=>$activities,'financial_year'=>$year]);
        $view->nest('pending_consolidation_view','action.partials.pending_consolidation',['pending_consolidation'=>$pending_consolidation]);
        $view->nest('budgets_view','action.partials.submitted_budgets',['submitted_budgets'=>$submitted_budgets,'financial_year'=>$year]);

        return $view;
	}

    public function listObjective(){
        $list_objective = $this->objective->get();
        return View::make('action/list_objective', compact('list_objective'));
    }

    public function listTarget(){

        $objectives = $this->objective->orderBy('ob_code')->get();
        $year = $this->year->where('status','=',1)->first();
		$unit = Unit::find(Auth::user()->unit_id);
        $submitted =$this->unitControl->is_submitted($year->id,Auth::user()->unit_id);
        $is_zone_submitted =ZoneControl::is_submitted($year->id,$unit->zone_id);

        return View::make('action/list_target', compact('objectives','submitted','is_zone_submitted'));
    }

    public function listActivity(){

        $list_activities = $this->activity->get();

        return View::make('action/list_activity', compact('list_activities'));
    }


    public function ObDetails($id){
        $objective = $this->objective->where('id','=', $id)->first();
        $target_list = $this->target->where('objective_id', '=', $id)->get();
        return View::make('action/ob_details', compact('objective','target_list'));
    }

    public function getSelectObjective(){
       $objectives =  Objective::all();
        return View::make('action/select_objective', compact('objectives'));
    }

public function getSelectedObjective(){

    $obj_id = Input::get('objective_id');
    $objective = $this->objective->where('id', '=', $obj_id)->first();
    $targets = $this->target->where('objective_id', '=', $obj_id)->get();
   // return View::make('admin/action/add_target', compact('targets','objective'));

    return Redirect::to('add_target/'.$obj_id);
}

    public function getUploadObjective()
    {
		$submitted_zone_budgets = $this->zoneControl->submitted_zone_budget();
		return var_dump($submitted_zone_budgets);
        return View::make('action/get_upload_objectives');
    }

    public function postUploadObjective()
    {
        $validator = Validator::make($data = Input::all(), Projection::$rules);
        if($validator->passes()){
            $destinationPath = public_path().'/uploads/objectives/';
            $file = Input::file('file_name');
            $t = time();
            $filename        = $t.'_'.$file->getClientOriginalName();
            $file->move($destinationPath, $filename);
            $path = $destinationPath.$filename;

            $results = Excel::selectSheets('Sheet1')->load($path,function($reader){

            })->get();

            foreach($results as $result){

                $objective = new Objective();

                $objective->ob_code = $result->objective_code;
                $objective->ob_description = $result->description;


                $objective->save();
            }

            return Redirect::to('list_objective');
        }else{
            return Redirect::back()->withInput()->withErrors($validator);
        }
    }



}
