<?php

class RefSubmissionsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

    protected $unit;
    public function __construct(Unit $unit){
        parent::__construct();
        $this->unit = $unit;
    }

    public function index()
	{
		//

        $items = RefSubmission::all();
        return View::make('ref_submissions/index', compact('items'));

	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
        $zones = Zone::where('deleted', '=', 0 )->get();
        return View::make('units/create', compact('zones'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
        $rules = [
            'zone_id'=>'required',
            'name' => 'required'

        ];
        $user = Auth::user();
        $valid = Validator::make(Input::all(),$rules);
        if($valid->passes()){
            $input = $this->unit;
            $input->zone_id = Input::get('zone_id');
            $input->name = Input::get('name');
            $input->save();

            return Redirect::to('units/index')->with('success', 'unit added successful');
        }else{
            return Redirect::back()->withInput()->withErrors($valid);
        }
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
        $zones = Zone::where('deleted', '=', 0 )->get();
        $unit = Unit::findOrFail($id);
        return View::make('units/edit', compact('unit', 'zones'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
        $rules = [
            'zone_id'=>'required',
            'name' => 'required'
        ];
        $input = Unit::findOrFail($id);
        $user = Auth::user();
        $valid = Validator::make(Input::all(),$rules);
        if($valid->passes()){
            $input->zone_id = Input::get('zone_id');
            $input->name = Input::get('name');
            $input->save();

            return Redirect::to('units/index')->with('success', 'unit updated successful');
        }else{
            return Redirect::back()->withInput()->withErrors($valid);
        }
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
        $input = Unit::findOrFail($id);
        $input->deleted = 1;
        $input->save();
        return Redirect::to('units/index')->with('success', 'unit deleted successful');
	}

    public function projection($id){

        $refSubmission = RefSubmission::find($id);
        return View::make('revenue_categories/add_projection', compact('refSubmission'));
    }

    public function postProjection()
    {
        $submission = new Submission();

        $financial_year = FinancialYear::where('status','=', 1)->first();
        $rules = [
            'unit_price'=>'required',
            'ref_submission_id'=>'required',
            'quantity'=>'required',
            'total_revenue'=>'required',
            'quarter_1'=>'required',
            'quarter_2'=>'required',
            'quarter_3'=>'required',
            'quarter_4'=>'required',
        ];
        $user = Auth::user();
        $validator = Validator::make(Input::all(),$rules);
        if($validator->passes()){
            $ref_submission_id = Input::get('ref_submission_id');
            $submission->unit_price = Input::get('unit_price');
            $submission->ref_submission_id = Input::get('ref_submission_id');
            $submission->quantity = Input::get('quantity');
            $submission->total_revenue = Input::get('total_revenue');
            $submission->quarter_1 = Input::get('quarter_1');
            $submission->quarter_2 = Input::get('quarter_2');
            $submission->quarter_3 = Input::get('quarter_3');
            $submission->quarter_4 = Input::get('quarter_4');
            $submission->created_by = $user->id;
            $submission->unit_id = $user->unit_id;
            $submission->financial_year = $financial_year->year;

            $submission->save();
            return Redirect::to('revenueCategory/addRefSubmission/'.$ref_submission_id );
        }else{
            return Redirect::back()->withInput()->withErrors($validator);
        }
    }



}
