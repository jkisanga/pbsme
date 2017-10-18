<?php

class SetupController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
    protected $year;
    public function __construct(FinancialYear $year){
        parent::__construct();
        $this->year = $year;
    }

	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
        return View::make('admin/setup/add_year');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function storeYear()
	{
        $rules = [
            'year'=>'required',
        ];

        $valid = Validator::make(Input::all(),$rules);

        if($valid->passes()){
            $input = new FinancialYear();
            $input->year = Input::get('year');
            $input->save();

            return Redirect::to('year');
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
	}


}
