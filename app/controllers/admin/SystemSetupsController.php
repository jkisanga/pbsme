<?php

class SystemSetupsController extends \BaseController {

	/**
	 * Display a listing of systemsetups
	 *
	 * @return Response
	 */

	public function getUploadGfs()
	{
		return View::make('admin/system_setups/upload_gfs');
	}

	public function postUploadGfs(){
        $validator = Validator::make($data = Input::all(), GfsCode::$rules);
        if($validator->passes()){
            $destinationPath = public_path().'/uploads/gfs/';
            $file = Input::file('file_name');
            $t = time();
            $filename        = $t.'_'.$file->getClientOriginalName();
            $file->move($destinationPath, $filename);
            $path = $destinationPath.$filename;
            $user = Auth::user();

            $results = Excel::selectSheets('Sheet1')->load($path,function($reader){

            })->get();

            foreach($results as $result){
                $gfsCode = new GfsCode();
                $gfsCode->code = $result->code;
                $gfsCode->item_description 	 = $result->description;
                $gfsCode->created_by = $user->id;
                $gfsCode->save();
            }

            return Redirect::to('myDashboard');
        }else{
            return Redirect::back()->withInput()->withErrors($validator);
        }



    }

// GFS Code form
	public function addGfs()
	{
        $gfsCodes = GfsCode::orderBy('item_description')->get();
		return View::make('admin.system_setups.add_gfs', compact('gfsCodes'));
	}

    public function postGfs(){
        $validator = Validator::make($data = Input::all(), GfsCode::$rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        $data['created_by'] = Auth::user()->id;
        GfsCode::create($data);
        return Redirect::to('admin/system/add_gfs')->with('success','Added successfully');
    }

    public function destroyGfs($id)
    {
        GfsCode::destroy($id);

        return Redirect::back()->with('success','Deleted successfully');
    }

// Items Unit Measure
	public function addUnitMeasure()
	{
        $unit_measures = RefUnitMeasure::orderBy('description')->get();
		return View::make('admin.system_setups.add_edit_unit_measure', compact('unit_measures'));
	}

    public function postUnitMeasure(){
        $validator = Validator::make($data = Input::all(), RefUnitMeasure::$rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        RefUnitMeasure::create($data);
        return Redirect::to('admin/system/add_unit_measure')->with('success','Added successfully');
    }

    public function destroyUnitMeasure($id)
    {
        RefUnitMeasure::destroy($id);

        return Redirect::back()->with('success','Deleted successfully');
    }

    #region USERS POSITION MANAGEMENT
    // get list of positions
    public function listPosition(){
        $values = Position::all();
        return View::make('admin.system_setups.position_list', compact('values'));
    }

    public function storePosition(){
        $validator = Validator::make($data = Input::all(), Position::$rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        Position::create($data);
        return Redirect::to('admin/system/positions')->with('success','Added successfully');
    }

    public function editPosition($id){
        $data = Position::find($id);
        return View::make('admin/system_setups/edit_position', compact('data'));
    }

    public function updatePosition($id){
        $validator = Validator::make($data = Input::all(), Position::$rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        $input = Position::find($id);
        $input->title = Input::get('title');
        $input->description = Input::get('description');
        $input->save();
        return Redirect::to('admin/system/positions')->with('success','Updated successfully');
    }

    public function deletePosition($id){

        Position::destroy($id);
        return Redirect::to('admin/system/positions')->with('success','Deleted successfully');
    }


    #endregion



}
