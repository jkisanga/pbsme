<?php

class KpisController extends \BaseController {

	/**
	 * Display a listing of kpis
	 *
	 * @return Response
	 */
	public function index()
	{
		$objectives = Objective::orderBy('ob_code')->get();

		return View::make('kpis.index', compact('objectives'));
	}

    public function objective()
	{
		$objectives = Objective::orderBy('ob_code')->get();

		return View::make('kpis.obj_index', compact('objectives'));
	}

	/**
	 * Show the form for creating a new kpi
	 *
	 * @return Response
	 */
	public function create($id)
	{
        $objective = Objective::find($id);
		return View::make('kpis.create', compact('objective'));
	}

	/**
	 * Store a newly created kpi in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Kpi::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Kpi::create($data);

		return Redirect::back();
		//return Redirect::to('kpis/index');
	}

	/**
	 * Display the specified kpi.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$kpi = Kpi::findOrFail($id);

		return View::make('kpis.show', compact('kpi'));
	}

	/**
	 * Show the form for editing the specified kpi.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$kpi = Kpi::find($id);

		return View::make('kpis.edit', compact('kpi'));
	}

	/**
	 * Update the specified kpi in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$kpi = Kpi::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Kpi::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$kpi->update($data);

		return Redirect::route('kpis.index');
	}

	/**
	 * Remove the specified kpi from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Kpi::destroy($id);

		return Redirect::route('kpis.index');
	}

		public function getFields($id)
		{
			$kpi = Kpi::find($id);
			$fields = RefKpiField::all();

			return View::make('kpis.fields', compact('kpi','fields'));
		}

		public function postFields($id)
		{

			$rules = [
				'fields' => 'required'
			];

			$valid = Validator::make($data = Input::all(),$rules);

			if($valid->passes()){
					$SelectedFields = $data['fields'];

					foreach ($SelectedFields as $key) {
						# code...

						if (KpiField::is_exist($data['kpi_id'],$key) == false) {
							# code...
							$kpifield = new KpiField();
							$kpifield->kpi_id =$data['kpi_id'];
							$kpifield->field_id =$key;
							$kpifield->save();
						}
					}
						return Redirect::back()->with('success', 'Fields has been Added');
		}else {
			# code...
			  return Redirect::back()->withInput()->withErrors($valid);
		}

 }

 public function getRemoveField($id)
 {
	 KpiField::destroy($id);
	 return Redirect::back()->with('success', 'Field has been removed');
 }

}
