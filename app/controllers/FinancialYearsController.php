<?php

class FinancialYearsController extends \BaseController {

	/**
	 * Display a listing of financialyears
	 *
	 * @return Response
	 */
	public function index()
	{
		$items = Financialyear::all();

		return View::make('financial_years.index', compact('items'));
	}

	/**
	 * Show the form for creating a new financialyear
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('financial_years.create');
	}

	/**
	 * Store a newly created financialyear in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

        $valid = Validator::make(Input::all(),FinancialYear::$rules);
		 $financialyear = Financialyear::where('year','=',Input::get('year'))->first();
		  
        if($valid->passes()){
			 if(count($financialyear) > 0){
				return Redirect::back()->with('error','Financial Year already exist')->withInput();
			}else{
				$input = new FinancialYear();
				$input->year = Input::get('year');
				$input->projection_percentage = Input::get('projection_percentage');
				$input->save();

				return Redirect::to('financial_year/index')->with('success','Year created successfully');
			}
       
        }else{
            return Redirect::back()->withInput()->withErrors($valid);
        }
	}

    public function edit($id)
    {
        $post = Financialyear::find($id);

        return View::make('financial_years.edit', compact('post'));
    }

    /**
     * Update the specified financialyear in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $financialyear = Financialyear::findOrFail($id);

        $validator = Validator::make($data = Input::all(), Financialyear::$rules);
        $year = Input::get('year');
        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }
       
        $financialyear->year = $year;
        $financialyear->projection_percentage = Input::get('projection_percentage');
        $financialyear->save();

        return Redirect::to('financial_year/index');
    }





	public function activate($id)
	{
		$post = Financialyear::find($id);

		return View::make('financial_years.activate', compact('post'));
	}

	/**
	 * Update the specified financialyear in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function storeActivate($id)
	{
		
		$rules = [
			'year' => 'required'
		];
		$financialyear = Financialyear::findOrFail($id);

		$validator = Validator::make($data = Input::all(),$rules);
        $year = Input::get('year');
		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}
        $active_year = FinancialYear::where('status','=', true)->first();
        if($active_year){
            $active_year->status = false;
            $active_year->save();
        }
		$financialyear->status = true;
        $financialyear->save();

		return Redirect::to('financial_year/index')->with('success','activated successfully');
	}

	/**
	 * Remove the specified financialyear from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Financialyear::destroy($id);

		return Redirect::route('financialyears.index');
	}

}
