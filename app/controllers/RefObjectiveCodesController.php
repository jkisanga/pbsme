<?php

class RefObjectiveCodesController extends \BaseController {

	/**
	 * Display a listing of refobjectivecodes
	 *
	 * @return Response
	 */
	public function index()
	{
		$refobjectivecodes = Refobjectivecode::all();

		return View::make('ref_objective_codes.index', compact('refobjectivecodes'));
	}

	/**
	 * Show the form for creating a new refobjectivecode
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('ref_objective_codes.create');
	}

	/**
	 * Store a newly created refobjectivecode in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        //
        $rules = [
            'name'=>'required',
            'code'=>'required|max:1',
        ];
        $valid = Validator::make(Input::all(),$rules);
        if($valid->passes()){
            $input = new RefObjectiveCode();
            $input->name = Input::get('name');
            $input->code = Input::get('code');
            $input->save();

            return Redirect::to('refObjectiveCode/index')->with('success', 'code added successful');
        }else{
            return Redirect::back()->withInput()->withErrors($valid);
        }
	}

	/**
	 * Display the specified refobjectivecode.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$refobjectivecode = Refobjectivecode::findOrFail($id);

		return View::make('refobjectivecodes.show', compact('refobjectivecode'));
	}

	/**
	 * Show the form for editing the specified refobjectivecode.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$refobjectivecode = Refobjectivecode::find($id);

		return View::make('ref_objective_codes.edit', compact('refobjectivecode'));
	}

	/**
	 * Update the specified refobjectivecode in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $rules = [
            'name'=>'required',
            'code'=>'required|max:1',
        ];
        $input = RefObjectiveCode::findOrFail($id);
        $valid = Validator::make(Input::all(),$rules);
        if($valid->passes()){
            $input->name = Input::get('name');
            $input->code = Input::get('code');
            $input->save();

            return Redirect::to('refObjectiveCode/index')->with('success', 'code updated successful');
        }else{
            return Redirect::back()->withInput()->withErrors($valid);
        }
	}

	/**
	 * Remove the specified refobjectivecode from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Refobjectivecode::destroy($id);

        return Redirect::to('refObjectiveCode/index')->with('success', 'code deleted successful');
	}

}
