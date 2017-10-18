<?php

class PlantationsController extends \BaseController {

	/**
	 * Display a listing of plantations
	 *
	 * @return Response
	 */
	public function index()
	{
		$plantations = Plantation::all();

		return View::make('plantations.index', compact('plantations'));
	}

	/**
	 * Show the form for creating a new plantation
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('plantations.create');
	}

	/**
	 * Store a newly created plantation in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Plantation::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Plantation::create($data);

		return Redirect::route('plantations.index');
	}

	/**
	 * Display the specified plantation.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$plantation = Plantation::findOrFail($id);

		return View::make('plantations.show', compact('plantation'));
	}

	/**
	 * Show the form for editing the specified plantation.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$plantation = Plantation::find($id);

		return View::make('plantations.edit', compact('plantation'));
	}

	/**
	 * Update the specified plantation in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$plantation = Plantation::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Plantation::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$plantation->update($data);

		return Redirect::route('plantations.index');
	}

	/**
	 * Remove the specified plantation from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Plantation::destroy($id);

		return Redirect::route('plantations.index');
	}

}
