<?php

class SubmissionsController extends \BaseController {

	/**
	 * Display a listing of submissions
	 *
	 * @return Response
	 */
	 
	protected $revenueControl;



    public function __construct(RevenueControl $revenueControl){
        parent::__construct();
        $this->revenueControl = $revenueControl;      
    }
	
	public function index()
	{
        $financial_year = FinancialYear::where('status','=', true)->first();
        $unit = Unit::where('id','=', Auth::user()->unit_id)->first();
        $items = Submission::revenue_categories();
		$submissions = Submission::where('unit_id', '=', Auth::user()->unit_id)->where('financial_year','=', $financial_year->id)->get();
		$unit_submited = $this->revenueControl->is_submitted($financial_year->id,Auth::user()->unit_id);


		return View::make('submissions.index', compact('items','submissions','unit_submited','unit','financial_year'));
	}

	/**
	 * Show the form for creating a new submission
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('submissions.create');
	}

	/**
	 * Store a newly created submission in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Submission::$rules);
        if($validator->passes()){
        $destinationPath = public_path().'/uploads/submissions/';
        $file = Input::file('file_name');
        $t = time();
        $filename        = $t.'_'.$file->getClientOriginalName();
        $file->move($destinationPath, $filename);
        $path = $destinationPath.$filename;
      $user = Auth::user();

        $results = Excel::selectSheets('Sheet1')->load($path,function($reader){

        })->get();

        foreach($results as $result){
            $submission = new Submission();
            $submission->item_code = $result->item_code;
            $submission->type_of_fee = $result->type_of_fees;
            $submission->zone_id = $user->unit_id;
            $submission->created_by = $user->id;

            $submission->save();
        }

		return Redirect::to('submissions/index');
        }else{
            return Redirect::back()->withInput()->withErrors($validator);
        }
	}

	/**
	 * Display the specified submission.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$submission = Submission::findOrFail($id);

		return View::make('submissions.show', compact('submission'));
	}

	/**
	 * Show the form for editing the specified submission.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$submission = Submission::find($id);
        $currentYear = FinancialYear::where('status', '=', true)->first();
		
		if(count(SubmissionClass::where('submission_id', '=',$submission->id)->get()) >0){
			
			return View::make('submissions.edit', compact('submission', 'currentYear'));
		}else{
			return View::make('submissions.edit2', compact('submission', 'currentYear'));
		}


	}

	/**
	 * Update the specified submission in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $balance = Input::get('balance');
        $total_revenue = Input::get('total_revenue');
        $remain = $total_revenue - $balance;
        if($balance >= 0) {
            $submission = Submission::find($id);
			$user = Auth::user();
			$classes = SubmissionClass::where('submission_id', '=',$submission->id)->get();
			
			if(count($classes)>0){								
				$dbh = Input::get('dbh');
				$rate = Input::get('rate');
				$volume = Input::get('volume');
				$groyality = Input::get('groyality');
				$royality = Input::get('croyality');
				$taff = Input::get('ctaff');
				
				foreach($classes as $class){
					switch($class['class']){
						case "Class I" :
							$class->rate = $rate[0];
							$class->volume = $volume[0];
							$class->grand_royalty = $groyality[0];
							$class->royalty = $royality[0];
							$class->taff = $taff[0];
							$class->save();
						break;
						case "Class II" :
							$class->rate = $rate[1];
							$class->volume = $volume[1];
							$class->grand_royalty = $groyality[1];
							$class->royalty = $royality[1];
							$class->taff = $taff[1];
							$class->save();
						break;
						case "Class III" :
							$class->rate = $rate[2];
							$class->volume = $volume[2];
							$class->grand_royalty = $groyality[2];
							$class->royalty = $royality[2];
							$class->taff = $taff[2];
							$class->save();
						break;
						case "Class IV" :
							$class->rate = $rate[3];
							$class->volume = $volume[3];
							$class->grand_royalty = $groyality[3];
							$class->royalty = $royality[3];
							$class->taff = $taff[3];
							$class->save();
						break;
					}
						
						$submission->total_revenue = Input::get('total_revenue');
						$submission->quarter_1 = Input::get('quarter_1');
						$submission->quarter_2 = Input::get('quarter_2');
						$submission->quarter_3 = Input::get('quarter_3');
						$submission->quarter_4 = Input::get('quarter_4');
						$submission->royalty = Input::get('royalty');
						$submission->vat = Input::get('vat');
						$submission->cess = Input::get('cess');
						$submission->taff = Input::get('taff');
						$submission->lmda = Input::get('lmda');
						$submission->tree = Input::get('tree');
						$submission->unit_id = $user->unit_id;
						$submission->status = 'filled';

						$submission->save();
				}
				  return Redirect::to('submissions/index');				
			}
			else{
				 $rules = [
                'unit_price' => 'required',
                'quantity' => 'required',

            ];
            $user = Auth::user();
            $validator = Validator::make(Input::all(), $rules);
            if ($validator->passes()) {
                $submission->unit_price = Input::get('unit_price');
                $submission->quantity = Input::get('quantity');
                $submission->total_revenue = Input::get('total_revenue');
                $submission->quarter_1 = Input::get('quarter_1');
                $submission->quarter_2 = Input::get('quarter_2');
                $submission->quarter_3 = Input::get('quarter_3');
                $submission->quarter_4 = Input::get('quarter_4');
                $submission->royalty = Input::get('royalty');
                $submission->vat = Input::get('vat');
                $submission->cess = Input::get('cess');
                $submission->taff = Input::get('taff');
                $submission->lmda = Input::get('lmda');
                $submission->tree = Input::get('tree');
                $submission->unit_id = $user->unit_id;
                $submission->status = 'filled';

                $submission->save();
                return Redirect::to('submissions/index');
            } else {
                return Redirect::back()->withInput()->withErrors($validator);
            }
			}
      
        }else{
            return Redirect::to('submissions/edit/'. $id)->withInput()->with('error', 'Total Revenue exceed Quarters Distribution by ' . $balance );
        }
	}

	/**
	 * Remove the specified submission from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Submission::destroy($id);

		return Redirect::route('submissions.index');
	}

    //Fetch references from references submission to submission table

    public function importReference(){

        $user = Auth::user();
        $financial = FinancialYear::where('status','=', true)->first();
        $unit = Unit::find($user->unit_id);
        $zone = Zone::find($unit->zone_id);


        $referencesSubmissions = RefSubmission::all();

        foreach($referencesSubmissions as $ref){
            $data = new Submission();
            $data->unit_id = $user->unit_id;
            $data->zone_id = $zone->id;
            $data->category_id = $ref->category_id;
            $data->item_code = $ref->item_code;
            $data->type_of_fee = $ref->type_of_fee;
            $data->percent_royalty = $ref->royalty;
            $data->percent_vat = $ref->vat;
            $data->percent_cess = $ref->cess;
            $data->percent_taff = $ref->taff;
            $data->percent_lmda = $ref->lmda;
            $data->percent_tree = $ref->tree;
            $data->financial_year = $financial->id;
           $data->save();
            if(count($ref->classes)  > 0) {
                foreach ($ref->classes as $value) {
                    $input = new SubmissionClass();
                    $input->unit_id = $user->unit_id;
                    $input->zone_id = $zone->id;
                    $input->financial_year = $financial->id;
                    $input->class = $value->class;
                    $input->rate = $value->rate;
                    $input->submission_id = $data->id;
                    $input->save();

                }
            }

        }



      return Redirect::to('submissions/index')->with('success', 'Successful Imported.');

    }

    //Unit Report
    public function unitReport(){
            $years = FinancialYear::all();
			$unit = Unit::find(Auth::user()->unit_id);
			$units = Unit::where('zone_id','=',$unit->zone_id)->where('deleted','=',0)->get();
			
            $view =  View::make('submissions/unit_report_view',compact('years','units','unit'));
			$view->nest('revenue_view','submissions.htmlViews.unit_report');
			return $view;
    }

    //poet unit Report to get html view
    public function postUnitReport()
    {
		
        $rules = [
            'year' => 'required',
        ];

        $valid = Validator::make($data = Input::all(), $rules);
		$years = FinancialYear::all();
		$unit = Unit::find(Auth::user()->unit_id);
		$units = Unit::where('zone_id','=',$unit->zone_id)->where('deleted','=',0)->get();
		
		 //unset current session data
            unset($_SESSION['financialYear']);
            unset( $_SESSION['items'] );
            unset( $_SESSION['unit'] );

		//set new data

            $_SESSION['financialYear'] = null;
            $_SESSION['items'] = null;
			
        if ($valid->passes()) {
            $years = FinancialYear::all();
            $financialYear = FinancialYear::find(Input::get('year'));			
            $items = Submission::revenue_categories();
			$print = true;
			
			if(isset($data['unit'])){
				$unit = Unit::find($data['unit']);
			}
			$_SESSION['financialYear'] =  $financialYear ;
            $_SESSION['items'] = $items;
            $_SESSION['unit'] = $unit;

          $view = View::make('submissions/unit_report_view',compact('years','print','units','unit'));
		  $view->nest('revenue_view','submissions.htmlViews.unit_report',['items'=>$items,'financialYear'=>$financialYear,'unit'=>$unit]);
		  return $view;
		  
		} else{

            return Redirect::back()
                ->withInput()
				->withErrors($valid);
			}         
         
        
    }

    public function downloadUnitReport(){
		 if(isset($_SESSION['financialYear']) && isset($_SESSION['items'])){
			 
			 $year =  $_SESSION['financialYear'];

            $parameter['items'] =  $_SESSION['items'] ;
            $parameter['financialYear'] = $_SESSION['financialYear'] ;
            $parameter['unit'] = $_SESSION['unit'] ;
           
            $headers = array(
                "Content-type"=>"application/ms-excel",
                "Content-Disposition"=>"attachment;Filename=revenue_projection_".$year->year.".xls"
            );
            $content = View::make('submissions/htmlViews/unit_report',$parameter);
            return Response::make($content,200, $headers);

        }else{
            return Redirect::back();
        }
        
    }
	
	//Zone Report
    public function zoneReport(){
            $years = FinancialYear::all();
			$zone = Zone::find(Auth::user()->unit->zone_id);
			$zones = Zone::where('deleted','=',0)->get();
			
            $view =  View::make('submissions/zone_report_view',compact('years','zones','zone'));
			$view->nest('revenue_view','submissions.htmlViews.zone_report');
			return $view;
    }

    //poet unit Report to get html view
    public function postZoneReport()
    {
		
        $rules = [
            'year' => 'required',
        ];

        $valid = Validator::make($data = Input::all(), $rules);
		$years = FinancialYear::all();
		$zone = Zone::find(Auth::user()->unit->zone_id);
		$zones = Zone::where('deleted','=',0)->get();
		
		 //unset current session data
            unset($_SESSION['financialYear']);
            unset( $_SESSION['items'] );
            unset( $_SESSION['zone'] );

		//set new data

            $_SESSION['financialYear'] = null;
            $_SESSION['items'] = null;
			
        if ($valid->passes()) {
            $years = FinancialYear::all();
            $financialYear = FinancialYear::find(Input::get('year'));			
            $items = Submission::revenue_categories();
			$print = true;
			
			if(isset($data['zone'])){
				$zone = Zone::find($data['zone']);
			}
			$_SESSION['financialYear'] =  $financialYear ;
            $_SESSION['items'] = $items;
            $_SESSION['zone'] = $zone;

          $view = View::make('submissions/zone_report_view',compact('years','print','zones','zone'));
		  $view->nest('revenue_view','submissions.htmlViews.zone_report',['items'=>$items,'financialYear'=>$financialYear,'zone'=>$zone]);
		  return $view;
		  
		} else{

            return Redirect::back()
                ->withInput()
				->withErrors($valid);
			}         
         
        
    }

    public function downloadZoneReport(){
		 if(isset($_SESSION['financialYear']) && isset($_SESSION['items'])){
			 
			 $year =  $_SESSION['financialYear'];

            $parameter['items'] =  $_SESSION['items'] ;
            $parameter['financialYear'] = $_SESSION['financialYear'] ;
            $parameter['zone'] = $_SESSION['zone'] ;
           
            $headers = array(
                "Content-type"=>"application/ms-excel",
                "Content-Disposition"=>"attachment;Filename=revenue_projection_".$year->year.".xls"
            );
            $content = View::make('submissions/htmlViews/zone_report',$parameter);
            return Response::make($content,200, $headers);

        }else{
            return Redirect::back();
        }
        
    }

    

}
