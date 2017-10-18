<?php

class RefTargetNosController extends \BaseController {

	/**
	 * Display a listing of reftargetnos
	 *
	 * @return Response
	 */
	public function index()
	{
		$reftargetnos = Reftargetno::all();

		return View::make('ref_target_nos.index', compact('reftargetnos'));
	}

	/**
	 * Show the form for creating a new reftargetno
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('ref_target_nos.create');
	}

	/**
	 * Store a newly created reftargetno in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        //
        $rules = [
            'name'=>'required',
            'no'=>'required',
        ];
        $valid = Validator::make(Input::all(),$rules);
        if($valid->passes()){
            $input = new RefTargetNo();
            $input->no = Input::get('no');
            $input->name = Input::get('name');
            $input->save();

            return Redirect::to('refTargetNo/index');
        }else{
            return Redirect::back()->withInput()->withErrors($valid);
        }
	}

	/**
	 * Display the specified reftargetno.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$reftargetno = Reftargetno::findOrFail($id);

		return View::make('reftargetnos.show', compact('reftargetno'));
	}

	/**
	 * Show the form for editing the specified reftargetno.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$reftargetno = Reftargetno::find($id);

		return View::make('ref_target_nos.edit', compact('reftargetno'));
	}

	/**
	 * Update the specified reftargetno in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $rules = [
            'no'=>'required',
            'name'=>'required',
        ];
        $input = RefTargetNo::findOrFail($id);
        $valid = Validator::make(Input::all(),$rules);
        if($valid->passes()){
            $input->name = Input::get('name');
            $input->no = Input::get('no');
            $input->save();

            return Redirect::to('refTargetNo/index');
        }else{
            return Redirect::back()->withInput()->withErrors($valid);
        }
	}

	/**
	 * Remove the specified reftargetno from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Reftargetno::destroy($id);

        return Redirect::to('refTargetNo/index')->with('success', 'code deleted successful');
	}

}
