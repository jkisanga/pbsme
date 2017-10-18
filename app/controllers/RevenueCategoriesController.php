<?php

class RevenueCategoriesController extends \BaseController {

	/**
	 * Display a listing of revenuecategories
	 *
	 * @return Response
	 */

    protected $revenueCategory;
    public function __construct(RevenueCategory $revenueCategory){
        parent::__construct();
        $this->revenueCategory = $revenueCategory;
    }

	public function index()
	{
        $items = $this->revenueCategory->get();
        return View::make('revenue_categories/index', compact('items'));
	}

	/**
	 * Show the form for creating a new revenuecategory
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('revenue_categories/create');
	}

	/**
	 * Store a newly created revenuecategory in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        //
        $rules = [
//            'item_code'=>'required',
            'name' => 'required'

        ];
        $valid = Validator::make(Input::all(),$rules);
        if($valid->passes()){
            $input = $this->revenueCategory;
//            $input->item_code = Input::get('item_code');
            $input->name = Input::get('name');
            $input->save();

            return Redirect::to('revenueCategory/index')->with('success', 'Revenue Category added successful');
        }else{
            return Redirect::back()->withInput()->withErrors($valid);
        }
	}

	/**
	 * Display the specified revenuecategory.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$revenuecategory = Revenuecategory::findOrFail($id);

		return View::make('revenuecategories.show', compact('revenuecategory'));
	}

	/**
	 * Show the form for editing the specified revenuecategory.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$item = Revenuecategory::find($id);

		return View::make('revenue_categories.edit', compact('item'));
	}

	/**
	 * Update the specified revenuecategory in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $rules = [
//            'item_code'=>'required',
            'name' => 'required'
        ];
        $input = $this->revenueCategory->findOrFail($id);
        $valid = Validator::make(Input::all(),$rules);
        if($valid->passes()){
//            $input->item_code = Input::get('item_code');
            $input->name = Input::get('name');
            $input->save();

            return Redirect::to('revenueCategory/index')->with('success', 'Revenue Category updated successful');
        }else{
            return Redirect::back()->withInput()->withErrors($valid);
        }
	}

	/**
	 * Remove the specified revenuecategory from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Revenuecategory::destroy($id);

        return Redirect::to('revenueCategory/index')->with('success', 'Revenue Category updated successful');
	}


    public function addRefSubmission($id)
    {
        $submission = Revenuecategory::find($id);
        $refSubmissions = RefSubmission::where('category_id', '=', $id)->get();
        return View::make('revenue_categories/add_submission', compact('submission', 'refSubmissions'));
    }

    /**
     * Update the specified revenuecategory in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function postRefSubmission($id)
    {
        $rules = [
            'item_code'=>'required',
            'type_of_fee' => 'required'
        ];
        $fData = FinancialYear::where('status','=', 1)->first();
        $input = new RefSubmission();
        $valid = Validator::make(Input::all(),$rules);
        if($valid->passes()){
            $input->item_code = Input::get('item_code');
            $input->type_of_fee = Input::get('type_of_fee');
            $input->royalty = Input::get('royalty');
            $input->taff = Input::get('taff');
            $input->vat = Input::get('vat');
            $input->cess = Input::get('cess');
            $input->lmda = Input::get('lmda');
            $input->tree = Input::get('tree');
            $input->f_year = $fData->id;
            $input->category_id = $id;
            $input->save();

            return Redirect::to('revenueCategory/addRefSubmission/'.$id);
        }else{
            return Redirect::back()->withInput()->withErrors($valid);
        }
    }

    public function editRefSubmission($id){

        $refSubmission = RefSubmission::find($id);
        return View::make('revenue_categories/edit_submission', compact('refSubmission'));
    }

    public function postEditRefSubmission($id){
        $rules = [
            'item_code'=>'required',
            'type_of_fee' => 'required'
        ];
        $input = RefSubmission::find($id);
        $submission = Revenuecategory::find($input->category_id);
        $valid = Validator::make(Input::all(),$rules);
        if($valid->passes()){
            $input->item_code = Input::get('item_code');
            $input->type_of_fee = Input::get('type_of_fee');
            $input->category_id = $submission->id;
            $input->save();

            return Redirect::to('revenueCategory/addRefSubmission/'.$submission->id)->with('success', 'Item updated successful');
        }else{
            return Redirect::back()->withInput()->withErrors($valid);
        }
    }

    public function deleteRefSubmission($id){
        $input = RefSubmission::find($id);
        RefSubmission::destroy($id);


        return Redirect::to('revenueCategory/addRefSubmission/'.$input->category_id)->with('success', 'Item deleted successful');

    }


    //add classes
    public function addClasses($id){

        $refSubmission = RefSubmission::find($id);
        return View::make('revenue_categories/add_class', compact('refSubmission'));
    }

    public function postClass(){

        $class = new RefSubmissionClass();
        $class->ref_submission_id = Input::get('ref_submission_id');
        $class->class = Input::get('class');

        $class->save();
        return Redirect::to('revenueCategory/classes/'.Input::get('ref_submission_id'));
    }

    public function deleteClass($id){

        RefSubmissionClass::destroy($id);
        return Redirect::back()->with('success', 'item deleted');

    }

}
