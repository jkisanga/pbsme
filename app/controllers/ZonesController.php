<?php

class ZonesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

    protected $zone;
    protected $unit;
    public function __construct(Zone $zone, Unit $unit){
        parent::__construct();
        $this->zone = $zone;
        $this->unit = $unit;
    }

    public function index()
	{
		//
        $title = 'Zone Management';
        $zones = $this->zone->where('deleted', '=', 0)->get();
        return View::make('zones/index', compact('zones', 'title'));

	}




    /**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
        return View::make('zones/create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
        $rules = [
            'zone_name'=>'required',
            'short_name' => 'required'
        ];
        $user = Auth::user();
        $valid = Validator::make(Input::all(),$rules);
        if($valid->passes()){
            $input = $this->zone;
            $input->zone_name = Input::get('zone_name');
            $input->short_name = Input::get('short_name');
            $input->created_by = $user->id;
            $input->save();

            return Redirect::to('zones/index')->with('success', 'zone added successful');
        }else{
            return Redirect::back()->withInput()->withErrors($valid);
        }
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
        $zone = Zone::findOrFail($id);
        return View::make('zones/edit', compact('zone'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
        $rules = [
            'zone_name'=>'required',
            'short_name' => 'required'
        ];
        $input = Zone::findOrFail($id);
        $user = Auth::user();
        $valid = Validator::make(Input::all(),$rules);
        if($valid->passes()){
            $input->zone_name = Input::get('zone_name');
            $input->short_name = Input::get('short_name');
            $input->created_by = $user->id;
            $input->save();

            return Redirect::to('zones/index')->with('success', 'zone updated successful');
        }else{
            return Redirect::back()->withInput()->withErrors($valid);
        }
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
        $input = Zone::findOrFail($id);
        $input->deleted = 1;
        $input->save();
        return Redirect::to('zones/index')->with('success', 'zone deleted successful');
	}

    //Add Unit
    public function addUnit($id){
        $zone = Zone::findOrFail($id);
        $units = Unit::where('zone_id', '=', $zone->id)->get();
        return View::make('zones/unit', compact('zone', 'units'));
    }

    //post Unit
    public function storeUnit($id)
    {
//
        $rules = [
            'zone_id' => 'required',
            'name' => 'required'

        ];
        $valid = Validator::make(Input::all(), $rules);
        if ($valid->passes()) {
            $input = $this->unit;
            $input->zone_id = Input::get('zone_id');
            $input->name = Input::get('name');
            $input->save();

            return Redirect::to('zones/unit/' . $id)->with('success', 'unit added successful');
        } else {
            return Redirect::back()->withInput()->withErrors($valid);
        }
    }


    //edit Units
    public function editUnit($id)
    {
        //
        $unit = Unit::findOrFail($id);
        return View::make('zones/edit_unit', compact('unit'));
    }

    public function updateUnit($id)
    {
        //
        $rules = [
            'zone_id'=>'required',
            'name' => 'required'
        ];
        $input = Unit::findOrFail($id);
        $user = Auth::user();
        $valid = Validator::make(Input::all(),$rules);
        if($valid->passes()){
            $input->zone_id = Input::get('zone_id');
            $input->name = Input::get('name');
            $input->save();

            return Redirect::to('zones/unit/' . Input::get('zone_id') )->with('success', 'unit updated successful');
        }else{
            return Redirect::back()->withInput()->withErrors($valid);
        }
    }




}
