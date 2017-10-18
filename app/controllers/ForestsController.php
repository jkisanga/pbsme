<?php

class ForestsController extends \BaseController {

	/**
	 * Display a listing of forests
	 *
	 * @return Response
	 */
	public function index()
	{
		$forests = Forest::all();

		return View::make('forests.index', compact('forests'));
	}

	/**
	 * Show the form for creating a new forest
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('forests.create');
	}

	/**
	 * Store a newly created forest in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Forest::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Forest::create($data);

		return Redirect::route('forests.index');
	}

	/**
	 * Display the specified forest.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$forest = Forest::findOrFail($id);

		return View::make('forests.show', compact('forest'));
	}

	/**
	 * Show the form for editing the specified forest.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$forest = Forest::find($id);

		return View::make('forests.edit', compact('forest'));
	}

	/**
	 * Update the specified forest in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$forest = Forest::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Forest::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$forest->update($data);

		return Redirect::route('forests.index');
	}

	/**
	 * Remove the specified forest from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Forest::destroy($id);

		return Redirect::route('forests.index');
	}

}
