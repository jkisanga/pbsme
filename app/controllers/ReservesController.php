<?php

class ReservesController extends \BaseController {

	/**
	 * Display a listing of reserves
	 *
	 * @return Response
	 */
	public function index()
	{
		$reserves = Reserf::all();

		return View::make('reserves.index', compact('reserves'));
	}

	/**
	 * Show the form for creating a new reserf
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('reserves.create');
	}

	/**
	 * Store a newly created reserf in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Reserf::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Reserf::create($data);

		return Redirect::route('reserves.index');
	}

	/**
	 * Display the specified reserf.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$reserf = Reserf::findOrFail($id);

		return View::make('reserves.show', compact('reserf'));
	}

	/**
	 * Show the form for editing the specified reserf.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$reserf = Reserf::find($id);

		return View::make('reserves.edit', compact('reserf'));
	}

	/**
	 * Update the specified reserf in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$reserf = Reserf::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Reserf::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$reserf->update($data);

		return Redirect::route('reserves.index');
	}

	/**
	 * Remove the specified reserf from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Reserf::destroy($id);

		return Redirect::route('reserves.index');
	}

}
