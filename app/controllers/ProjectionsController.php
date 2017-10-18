<?php

class ProjectionsController extends \BaseController {

	/**
	 * Display a listing of projections
	 *
	 * @return Response
	 */
	public function index()
	{
		$projections = Projection::all();
		return View::make('projections.index', compact('projections'));
	}

	/**
	 * Show the form for creating a new projection
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('projections.create');
	}

	/**
	 * Store a newly created projection in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $validator = Validator::make($data = Input::all(), Projection::$rules);
        if($validator->passes()){
            $destinationPath = public_path().'/uploads/projections/';
            $file = Input::file('file_name');
            $t = time();
            $filename        = $t.'_'.$file->getClientOriginalName();
            $file->move($destinationPath, $filename);
            $path = $destinationPath.$filename;
            $user = Auth::user();

            $results = Excel::selectSheets('Sheet1')->load($path,function($reader){

            })->get();

            foreach($results as $result){
                $projection = new Projection();
                $projection->item_code = $result->item_code;
                $projection->type_of_fee = $result->type_of_fees;
                $projection->zone_id = $user->unit_id;
                $projection->created_by = $user->id;

                $projection->save();
            }

            return Redirect::to('projections/index');
        }else{
            return Redirect::back()->withInput()->withErrors($validator);
        }
	}

	/**
	 * Display the specified projection.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$projection = Projection::findOrFail($id);

		return View::make('projections.show', compact('projection'));
	}

	/**
	 * Show the form for editing the specified projection.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$projection = Projection::find($id);

		return View::make('projections.edit', compact('projection'));
	}

	/**
	 * Update the specified projection in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$projection = Projection::findOrFail($id);


        $rules = [
            'current_year'=>'required',
            'projected_year'=>'required',

        ];
        $user = Auth::user();
        $validator = Validator::make(Input::all(),$rules);
        if($validator->passes()){
            $projection->current_year = Input::get('current_year');
            $projection->projected_year = Input::get('projected_year');
            $projection->created_by = $user->id;

            $projection->save();
            return Redirect::to('projections/index');
        }else{
            return Redirect::back()->withInput()->withErrors($validator);
        }
	}

	/**
	 * Remove the specified projection from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Projection::destroy($id);

		return Redirect::route('projections.index');
	}

}
