<?php

class PersonalEmolumentsController extends \BaseController {

	/**
	 * Display a listing of personalemoluments
	 *
	 * @return Response
	 */
	public function index()
	{
        $user = Auth::user();
        $items = Personalemolument::where('unit_id','=', $user->unit_id)->get();

        $financial_year = FinancialYear::where('status', '=', true)->first();


        return View::make('personal_emoluments.index', compact('items', 'financial_year'));
	}

	/**
	 * Show the form for creating a new personalemolument
	 *
	 * @return Response
	 */
	public function create()
	{
        $refEmoluments = RefEmolument::all();
        $financial_year = FinancialYear::where('status','=', true)->first();
		return View::make('personal_emoluments.create', compact('refEmoluments', 'financial_year'));
	}

    public function createExcel()
	{
        $refEmoluments = RefEmolument::all();
        $financial_year = FinancialYear::where('status','=', true)->first();
		return View::make('personal_emoluments.create_excel', compact('refEmoluments', 'financial_year'));
	}

	/**
	 * Store a newly created personalemolument in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Personalemolument::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

        $user = Auth::user();

		$input = new PersonalEmolument();
        $input->code_no = Input::get('code_no');
        $input->designation = Input::get('designation');
        $input->salary_scale = Input::get('salary_scale');
        $input->established_meaning_level = Input::get('established_meaning_level');
        $input->actual_strength = Input::get('actual_strength');
        $input->approved_establishment = Input::get('approved_establishment');
        $input->approved_estimate = Input::get('approved_estimate');
        $input->approved_establishment_next = Input::get('approved_establishment_next');
        $input->approved_estimate_next = Input::get('approved_estimate_next');
        $input->unit_id = $user->unit_id;
        $input->financial_year = Input::get('financial_year');
        $input->save();

		return Redirect::to('personal_emoluments/index');
	}

    public function storeExcel()
	{

		$validator = Validator::make($data = Input::all(), Personalemolument::$rules1);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

        $destinationPath = public_path().'/uploads/personal_emoluments/';
        $file = Input::file('file_name');
        $t = time();
        $filename        = $t.'_'.$file->getClientOriginalName();
        $file->move($destinationPath, $filename);
        $path = $destinationPath.$filename;

        $results = Excel::selectSheets('Personal_Emolument_Template')->load($path,function($reader){

        })->get();
        $user = Auth::user();
        $activeYear = FinancialYear::where('status', '=', true)->first();

        $financialYear = $activeYear->year;
        foreach ($results as $result) {

            $input = new PersonalEmolument();

            $input->code_no = $result->code_no;
            $input->designation = $result->designation;
            $input->salary_scale = $result->salary_scale;
            $input->established_meaning_level = $result->established_meaning_level;
            $input->actual_strength = $result->ACTUAL_STRENGTH;
            $input->approved_establishment = $result->APPROVED_ESTABLISH;
            $input->approved_estimate = $result->APPROVED_ESTIMATES;
            $input->approved_establishment_next = $result->APPROVED_ESTABLISH;
            $input->approved_estimate_next = $result->APPROVED_ESTIMATES;
            $input->unit_id = $user->unit_id;
            $input->financial_year = $financialYear;
            //$input->save();
           var_dump($input);
            var_dump('<br>');
           var_dump($result);
        }



		//return Redirect::to('personal_emoluments/index');
	}

	/**
	 * Display the specified personalemolument.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$personalemolument = Personalemolument::findOrFail($id);

		return View::make('personalemoluments.show', compact('personalemolument'));
	}

	/**
	 * Show the form for editing the specified personalemolument.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$post = Personalemolument::find($id);
        $refEmoluments = RefEmolument::all();
        $financial_year = FinancialYear::where('status','=', true)->first();
		return View::make('personal_emoluments.edit', compact('post', 'refEmoluments','financial_year'));
	}

	/**
	 * Update the specified personalemolument in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $input = Personalemolument::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Personalemolument::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

        $user = Auth::user();

        $input->code_no = Input::get('code_no');
        $input->designation = Input::get('designation');
        $input->salary_scale = Input::get('salary_scale');
        $input->established_meaning_level = Input::get('established_meaning_level');
        $input->actual_strength = Input::get('actual_strength');
        $input->approved_establishment = Input::get('approved_establishment');
        $input->approved_estimate = Input::get('approved_estimate');
        $input->approved_establishment_next = Input::get('approved_establishment_next');
        $input->approved_estimate_next = Input::get('approved_estimate_next');
        $input->unit_id = $user->unit_id;
        $input->financial_year = Input::get('financial_year');
        $input->save();

        return Redirect::to('personal_emoluments/index');
	}


    public function getRemark($id){
        $post = Personalemolument::find($id);
        $financial_year = FinancialYear::where('status','=', true)->first();
        return View::make('personal_emoluments.remark', compact('post','financial_year'));
    }



    //post personal emolument remarks
    public function postRemark($id){

        $input = Personalemolument::findOrFail($id);

        $input->remark = Input::get('remark');
        $input->remark_no = Input::get('remark_no');
        $input->over_under = Input::get('over_under');
        $input->save();

        return Redirect::to('personal_emoluments/index')->with('success', 'Remark Saved');

    }



    /**
	 * Remove the specified personalemolument from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Personalemolument::destroy($id);

		return Redirect::route('personalemoluments.index');
	}

    public function getForm8A(){
        $years = FinancialYear::all();
        return View::make('personal_emoluments/form8A',compact('years'));

    }

    public function postForm8A(){

        $rules = [
            'year' =>'required',
        ];

        $valid = Validator::make(Input::all(), $rules);

        if ($valid->passes()) {
            $years = FinancialYear::all();
            $financialYear = Input::get('year');
            $items = PersonalEmolument::where('unit_id','=',(Auth::user()->unit_id))->where('financial_year', '=',$financialYear)->get();

            $establishedMeaningLevelSum = 0;
            $actualStrengthSum = 0;
            $approvedEstablishmentSum = 0;
            $approvedEstimateSum = 0;
            $approvedEstablishmentNextSum = 0;
            $approvedEstimateNextSum = 0;

            foreach($items as $itemSum){
                $establishedMeaningLevelSum = $establishedMeaningLevelSum + $itemSum->established_meaning_level;
                $actualStrengthSum = $actualStrengthSum + $itemSum->actual_strength;
                $approvedEstablishmentSum = $approvedEstablishmentSum + $itemSum->approved_establishment;
                $approvedEstimateSum = $approvedEstimateSum + $itemSum->approved_estimate;
                $approvedEstablishmentNextSum = $approvedEstablishmentNextSum + $itemSum->approved_establishment_next;
                $approvedEstimateNextSum = $approvedEstimateNextSum + $itemSum->approved_establishment_next;
            }

            return View::make('personal_emoluments/form8A', compact('years', 'items','financialYear',
                'establishedMeaningLevelSum', 'actualStrengthSum','approvedEstablishmentSum',
                'approvedEstimateSum', 'approvedEstablishmentNextSum','approvedEstimateNextSum'));
        }else{

            return Redirect::back()
                ->withInput()
                ->withErrors($valid);
        }

    }

    public function downloadForm8A($year){
        $items = PersonalEmolument::where('unit_id','=',(Auth::user()->unit_id))->where('financial_year', '=', $year)->get();
        $establishedMeaningLevelSum = 0;
        $actualStrengthSum = 0;
        $approvedEstablishmentSum = 0;
        $approvedEstimateSum = 0;
        $approvedEstablishmentNextSum = 0;
        $approvedEstimateNextSum = 0;

        $title = '2(b) 14: Schedule of Approved Personal Emoluments - Annual Estimates ';


        foreach($items as $itemSum){
            $establishedMeaningLevelSum = $establishedMeaningLevelSum + $itemSum->established_meaning_level;
            $actualStrengthSum = $actualStrengthSum + $itemSum->actual_strength;
            $approvedEstablishmentSum = $approvedEstablishmentSum + $itemSum->approved_establishment;
            $approvedEstimateSum = $approvedEstimateSum + $itemSum->approved_estimate;
            $approvedEstablishmentNextSum = $approvedEstablishmentNextSum + $itemSum->approved_establishment_next;
            $approvedEstimateNextSum = $approvedEstimateNextSum + $itemSum->approved_establishment_next;
        }
        $headers = array(
            "Content-type"=>"application/ms-excel",
            "Content-Disposition"=>"attachment;Filename= Form8A.xls"
        );
        $content = View::make('personal_emoluments/htmlViews/form8AHtml',array('items' => $items,'financialYear'=>$year,
              'establishedMeaningLevelSum' => $establishedMeaningLevelSum,  'actualStrengthSum' => $actualStrengthSum,
        'approvedEstablishmentSum' => $approvedEstablishmentSum, 'approvedEstimateSum' => $approvedEstimateSum,
        'approvedEstablishmentNextSum' => $approvedEstablishmentNextSum, 'approvedEstimateNextSum' => $approvedEstimateNextSum,
        'title' => $title ));

        return Response::make($content,200, $headers);

    }

    //Download Form 8A Template
    public function downloadEmolumentTemplate(){

        $financialYear = FinancialYear::where('status', '=', true)->first();
        $items = RefEmolument::all();
        $headers = array(
            "Content-type"=>"application/ms-excel",
            "Content-Disposition"=>"attachment;Filename= Personal_Emolument_Template.xls"
        );

        $content = View::make('personal_emoluments/htmlViews/emolument_template', array('items' => $items, 'financialYear' => $financialYear->year));
        return Response::make($content, 200, $headers);
    }

}
