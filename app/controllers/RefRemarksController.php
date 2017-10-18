<?php

class RefRemarksController extends \BaseController {

	/**
	 * Display a listing of refremarks
	 *
	 * @return Response
	 */
	public function index()
	{
		$items = Refremark::all();

		return View::make('ref_remarks.index', compact('items'));
	}

	/**
	 * Show the form for creating a new refremark
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('ref_remarks.create');
	}

	/**
	 * Store a newly created refremark in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Refremark::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

        $name = Input::get('name');
		$data = new RefRemark();
        $data->name = $name;
        $data->save();

		return Redirect::to('pe_remarks/create')->with('success', $name .' Limehifadhiwa Vyema');
	}

	/**
	 * Display the specified refremark.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$refremark = Refremark::findOrFail($id);

		return View::make('refremarks.show', compact('refremark'));
	}

	/**
	 * Show the form for editing the specified refremark.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$refremark = Refremark::find($id);

		return View::make('refremarks.edit', compact('refremark'));
	}

	/**
	 * Update the specified refremark in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$refremark = Refremark::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Refremark::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$refremark->update($data);

		return Redirect::route('refremarks.index');
	}

	/**
	 * Remove the specified refremark from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Refremark::destroy($id);

		return Redirect::route('refremarks.index');
	}

}
