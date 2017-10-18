<?php

class Form8asController extends \BaseController {

	/**
	 * Display a listing of form8as
	 *
	 * @return Response
	 */
	public function index()
	{
        $user = Auth::user();
		$items = Form8a::where('unit_id','=', $user->unit_id)->get();

        $financial_year = FinancialYear::where('status', '=', true)->first();

		return View::make('form8as.index', compact('items', 'financial_year'));

	}

	/**
	 * Show the form for creating a new form8a
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('form8as.create');
	}

	/**
	 * Store a newly created form8a in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Form8a::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Form8a::create($data);

		return Redirect::route('form8as.index');
	}

	/**
	 * Display the specified form8a.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$form8a = Form8a::findOrFail($id);

		return View::make('form8as.show', compact('form8a'));
	}

	/**
	 * Show the form for editing the specified form8a.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$form8a = Form8a::find($id);

		return View::make('form8as.edit', compact('form8a'));
	}

	/**
	 * Update the specified form8a in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$form8a = Form8a::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Form8a::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$form8a->update($data);

		return Redirect::route('form8as.index');
	}

	/**
	 * Remove the specified form8a from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Form8a::destroy($id);

		return Redirect::route('form8as.index');
	}

}
