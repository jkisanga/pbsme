<?php

class UnitsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

    protected $unit;
    public function __construct(Unit $unit){
        parent::__construct();
        $this->unit = $unit;
    }

    public function index()
	{
		//
        $title = 'Unit Management';
        $units = $this->unit->get();
        return View::make('units/index', compact('units', 'title'));

	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
        $zones = Zone::where('deleted', '=', 0 )->get();
        return View::make('units/create', compact('zones'));
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
            'zone_id'=>'required',
            'name' => 'required'

        ];
        $user = Auth::user();
        $valid = Validator::make(Input::all(),$rules);
        if($valid->passes()){
            $input = $this->unit;
            $input->zone_id = Input::get('zone_id');
            $input->name = Input::get('name');
            $input->save();

            return Redirect::to('units/index')->with('success', 'unit added successful');
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
        $zones = Zone::where('deleted', '=', 0 )->get();
        $unit = Unit::findOrFail($id);
        return View::make('units/edit', compact('unit', 'zones'));
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

            return Redirect::to('units/index')->with('success', 'unit updated successful');
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
        $input = Unit::findOrFail($id);
         $input->delete();
        $input->save();
        return Redirect::to('units/index')->with('success', 'unit deleted successful');
	}


}
