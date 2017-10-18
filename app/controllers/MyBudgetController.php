<?php

class MyBudgetController extends \BaseController {

    protected $objective;
    protected $target;
    protected $activity;
    protected $item;

    public function __construct(Objective $objective, Target $target, Activity $activity, Item $item)
    {
        parent::__construct();
        $this->objective = $objective;
        $this->target = $target;
        $this->activity = $activity;
        $this->item = $item;
    }

    public function getExcel(){
        $headers = array(
            "Content-type"=>"application/ms-excel",
            "Content-Disposition"=>"attachment;Filename=budget.xls"
        );
        $content = View::make('mybudget/excel',array('objectives' => $this->objective->all(), 'sum' => 0));

        return Response::make($content,200, $headers);

        Excel::create('FTS Budget', function($excel){

            $excel->sheet('LZ', function($sheet) {
                //$sheet->setAllBorders('thin');

               // $sheet->setAutoSize(true);
                // $sheet->setOrientation('landscape');
                $sheet->loadView('mybudget/excel',array('objectives' => $this->objective->all(), 'sum' => 0));
            });

            $excel->sheet('SZ', function($sheet) {
                $sheet->setAllBorders('thin');

                $sheet->setAutoSize(true);
                // $sheet->setOrientation('landscape');
                $sheet->loadView('mybudget/excel',array('objectives' => $this->objective->all(), 'sum' => 0));
            });

        })->export('xlsx');


    }
    public function getPdf(){
        $objectives = $this->objective->all();

        Excel::create('FTS Budget', function($excel){

            $excel->sheet('Excel sheet', function($sheet) {

                // $sheet->setOrientation('landscape');
                $sheet->loadView('mybudget/excel',array('objectives' => $this->objective->all(), 'sum' => 0));
            });



        })->export('pdf');
    }

    public function getCSV(){
        Excel::create('FTS Budget', function($excel){

            $excel->sheet('Excel sheet', function($sheet) {

                // $sheet->setOrientation('landscape');
                $sheet->loadView('mybudget/excel',array('objectives' => $this->objective->all(), 'sum' => 0));
            });

        })->export('csv');
    }

    public function index()
    {

        $objectives = $this->objective->all();

        $sum = 0;
        return View::make('mybudget/index', compact('objectives', 'sum'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
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
