<?php

class RefEmolumentsController extends \BaseController {

	/**
	 * Display a listing of refemoluments
	 *
	 * @return Response
	 */
	public function index()
	{
		$refemoluments = Refemolument::all();

		return View::make('ref_emoluments.index', compact('refemoluments'));
	}

	/**
	 * Show the form for creating a new refemolument
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('ref_emoluments.create');
	}




	public function store()
	{
		$validator = Validator::make($data = Input::all(), Refemolument::$rules);

        if($validator->passes()){
            $input = new Refemolument();
            $input->code_no = Input::get('code_no');
            $input->designation = Input::get('designation');
            $input->salary_scale = Input::get('salary_scale');
            $input->save();

            return Redirect::to('emoluments/index');
        }else{
            return Redirect::back()->withInput()->withErrors($validator);
        }
	}



    public function createUpload()
    {
        return View::make('ref_emoluments.create_upload');
    }


    public function storeUpload()
    {
        $validator = Validator::make($data = Input::all(), Refemolument::$rules1);
        if($validator->passes()){
            $destinationPath = public_path().'/uploads/emolument/';
            $file = Input::file('file_name');
            $t = time();
            $filename        = $t.'_'.$file->getClientOriginalName();
            $file->move($destinationPath, $filename);
            $path = $destinationPath.$filename;
            $user = Auth::user();

            $results = Excel::selectSheets('Sheet1')->load($path,function($reader){

            })->get();

            foreach($results as $result){

                $input = new Refemolument();

                $input->code_no = $result->code_no;
                $input->designation = $result->designation;
                $input->salary_scale = $result->salary_scale;
                $input->save();
               // var_dump($input->salary_scale);

            }

           return Redirect::to('emoluments/index');

        }else{
            return Redirect::back()->withInput()->withErrors($validator);
        }
    }














	public function show($id)
	{
		$refemolument = Refemolument::findOrFail($id);

		return View::make('refemoluments.show', compact('refemolument'));
	}

	/**
	 * Show the form for editing the specified refemolument.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$refemolument = Refemolument::find($id);

		return View::make('refemoluments.edit', compact('refemolument'));
	}

	/**
	 * Update the specified refemolument in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$refemolument = Refemolument::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Refemolument::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$refemolument->update($data);

		return Redirect::route('refemoluments.index');
	}

	/**
	 * Remove the specified refemolument from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Refemolument::destroy($id);

		return Redirect::route('refemoluments.index');
	}

}
