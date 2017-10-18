<?php
use Illuminate\Database\Schema\Blueprint;

class RefKpiFieldsController extends \BaseController {

	/**
	 * Display a listing of kpis
	 *
	 * @return Response
	 */
	public function index()
	{
	  $fields = RefKpiField::all();
	  return View::make('ref_kpi_fields.index', compact('fields'));
	}


	/**
	 * Show the form for creating a new kpi
	 *
	 * @return Response
	 */
	public function create()
	{
		$fields = RefKpiField::all();
		return View::make('ref_kpi_fields.create',compact('fields'));
	}

	/**
	 * Store a newly created kpi in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), RefKpiField::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}else{


			if(Schema::hasColumn('kpi_evaluations', Input::get('name')))  //check whether  table has  column
			{
 				return Redirect::back()->with('warning','column already exists');
			}else{
			
				RefKpiField::create($data);

				Schema::table('kpi_evaluations', function(Blueprint $table)
				{
					//
					$data_type = Input::get('data_type');
					if($data_type == 'enum'){
						$table->$data_type(Input::get('name'), explode(',', Input::get('options')));
					}else{
						$table->$data_type(Input::get('name'));
					}

				});

				 return Redirect::back()->with('success','field has been added');
			}

		}



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
		$kpiField = RefKpiField::find($id);
		 $fields = RefKpiField::all();

		return View::make('ref_kpi_fields.create', compact('kpiField','fields'));
	}

	/**
	 * Update the specified kpi in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$validator = Validator::make($data = Input::all(), RefKpiField::$rules);
		$kpiField = RefKpiField::find($id);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}else{


			if(Schema::hasColumn('kpi_evaluations', Input::get('name')))  //check whether  table has  column
			{
 				$kpiField->update($data);
				
				return Redirect::to('refKpiFields/create')->with('success','Field Updated succesfully');
			}else{
							
				Schema::table('kpi_evaluations', function($table)use($kpiField)
				{
					$table->dropColumn($kpiField->name);
				});
				
				$kpiField->update($data);

				Schema::table('kpi_evaluations', function(Blueprint $table)
				{
					//
					$data_type = Input::get('data_type');
					if($data_type == 'enum'){
						$table->$data_type(Input::get('name'), explode(',', Input::get('options')));
					}else{
						$table->$data_type(Input::get('name'));
					}

				});

			return Redirect::to('refKpiFields/create')->with('success','Field Updated succesfully');
			}

		}


	}

	/**
	 * Remove the specified kpi from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{

		$field = RefKpiField::find($id);
		KpiField::where("field_id", $field->id)->delete();
		RefKpiField::destroy($id);
		Schema::table('kpi_evaluations', function(Blueprint $table) use ($field)
		{
			//
				if(Schema::hasColumn('kpi_evaluations', $field->name) ) //check whether  table has  column
				{
					$table->dropColumn($field->name);
				}

		});

			return Redirect::to('refKpiFields/create')->with('success','field has been deleted');
	}


}
