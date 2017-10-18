<?php

class Submission extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		'file_name' => 'required'
	];
    protected $table = 'tfs_submissions';

	// Don't forget to fill this array
	protected $fillable = ['id', 'token'];


    public function refSubmission(){
         return $this->belongsTo('RefSubmission', 'ref_submission_id', 'id');

    }
    public function unit(){
        return $this->belongsTo('Unit', 'unit_id', 'id');

    }
    public function category(){
        return $this->belongsTo('RevenueCategory', 'category_id', 'id');
    }
			
	#region Unit level query
	//all revenue categories
	 public static function revenue_categories(){
		 return  DB::table('tfs_revenue_categories')
                        ->join('tfs_submissions', 'tfs_revenue_categories.id', '=', 'tfs_submissions.category_id')
                        ->groupBy('tfs_submissions.category_id')
                          ->select('tfs_revenue_categories.*')
                         ->get();
	 }
	 
	  //unit Royality category and financial year
	 public static function unit_royality($category_id,$year_id,$unit_id){
		 
		 return Submission::where('category_id','=', $category_id)
                            ->where('unit_id','=', $unit_id)
                            ->where('financial_year', '=', $year_id)
                            ->groupBy('category_id')
							->sum('royalty');
	 }
	   //unit Royality category and financial year
	 public static function unit_vat($category_id,$year_id,$unit_id){
		 
		 return Submission::where('category_id','=', $category_id)
                            ->where('unit_id','=', $unit_id)
                            ->where('financial_year', '=', $year_id)
                            ->groupBy('category_id')
							->sum('vat');
	 }
	   //unit Royality category and financial year
	 public static function unit_cess($category_id,$year_id,$unit_id){
		 
		 return Submission::where('category_id','=', $category_id)
                            ->where('unit_id','=', $unit_id)
                            ->where('financial_year', '=', $year_id)
                            ->groupBy('category_id')
							->sum('cess');
	 }
	   //unit Royality category and financial year
	 public static function unit_taff($category_id,$year_id,$unit_id){
		 
		 return Submission::where('category_id','=', $category_id)
                            ->where('unit_id','=', $unit_id)
                            ->where('financial_year', '=', $year_id)
                            ->groupBy('category_id')
							->sum('taff');
	 }
	    //unit Royality category and financial year
	 public static function unit_lmda($category_id,$year_id,$unit_id){
		 
		 return Submission::where('category_id','=', $category_id)
                            ->where('unit_id','=', $unit_id)
                            ->where('financial_year', '=', $year_id)
                            ->groupBy('category_id')
							->sum('lmda');
	 }
	    //unit Royality category and financial year
	 public static function unit_tree($category_id,$year_id,$unit_id){
		 
		 return Submission::where('category_id','=', $category_id)
                            ->where('unit_id','=', $unit_id)
                            ->where('financial_year', '=', $year_id)
                            ->groupBy('category_id')
							->sum('tree');
	 }
	 
	  //unit Royality category and financial year
	 public static function unit_total_royality($year_id,$unit_id){
		 
		 return Submission::where('unit_id','=', $unit_id)
                            ->where('financial_year', '=', $year_id)
							->sum('royalty');
	 }
	   //unit Royality category and financial year
	 public static function unit_total_vat($year_id,$unit_id){
		 
		 return Submission::where('unit_id','=', $unit_id)
                            ->where('financial_year', '=', $year_id)
							->sum('vat');
	 }
	   //unit Royality category and financial year
	 public static function unit_total_cess($year_id,$unit_id){
		 
		 return Submission::where('unit_id','=', $unit_id)
                            ->where('financial_year', '=', $year_id)
							->sum('cess');
	 }
	   //unit Royality category and financial year
	 public static function unit_total_taff($year_id,$unit_id){
		 
		 return Submission::where('unit_id','=', $unit_id)
                            ->where('financial_year', '=', $year_id)
							->sum('taff');
	 }
	    //unit Royality category and financial year
	 public static function unit_total_lmda($year_id,$unit_id){
		 
		 return Submission::where('unit_id','=', $unit_id)
                            ->where('financial_year', '=', $year_id)
							->sum('lmda');
	 }
	    //unit Royality category and financial year
	 public static function unit_total_tree($year_id,$unit_id){
		 
		 return Submission::where('unit_id','=', $unit_id)
                            ->where('financial_year', '=', $year_id)
							->sum('tree');
	 }
	 
	 //unit revenue by revenue category and financial year
	 public static function unit_revenue($category_id,$year_id,$unit_id){
		 
		 return Submission::where('category_id','=', $category_id)
                            ->where('unit_id','=', $unit_id)
                            ->where('financial_year', '=', $year_id)
                            ->get();
	 }
	 
	  //unit total revenue by revenue category and financial year
	 public static function total_revenue($category_id,$year_id,$unit_id){
		 
		 return  DB::table('tfs_submissions')
                    
                     ->where('category_id', '=', $category_id)
                     ->where('financial_year', '=', $year_id)
					 ->where('unit_id','=', $unit_id)
                     ->groupBy('category_id')
                     ->sum('total_revenue');
					 					 		
	 }
 //unit grand revenue by financial year
	 public static function grand_total_revenue($year_id,$unit_id){
		 
		 return  DB::table('tfs_submissions')                   
                     ->where('financial_year', '=', $year_id)
					   ->where('unit_id','=', $unit_id)
                     ->sum('total_revenue');
					 					 		
	 }
	  //unit total quarter one by revenue category and financial year
	 public static function total_quarter1($category_id,$year_id,$unit_id){
		 
		 return  DB::table('tfs_submissions')
                    
                     ->where('category_id', '=', $category_id)
                     ->where('financial_year', '=', $year_id)
					   ->where('unit_id','=', $unit_id)
                     ->groupBy('category_id')
                     ->sum('quarter_1');
					 					 		
	 } 
 //unit quarter one grand total by financial year
	 public static function grand_total_quarter1($year_id,$unit_id){
		 
		 return  DB::table('tfs_submissions')               
                     ->where('financial_year', '=', $year_id)
					  ->where('unit_id','=', $unit_id)
                     ->sum('quarter_1');
					 					 		
	 } 
	 //unit total quarter two by revenue category and financial year
	 public static function total_quarter2($category_id,$year_id,$unit_id){
		 
		 return  DB::table('tfs_submissions')
                    
                     ->where('category_id', '=', $category_id)
                     ->where('financial_year', '=', $year_id)
					   ->where('unit_id','=', $unit_id)
                     ->groupBy('category_id')
                     ->sum('quarter_2');
					 					 		
	 } 
   //unit quarter two grand total by revenue category and financial year
	 public static function grand_total_quarter2($year_id,$unit_id){
		 
		 return  DB::table('tfs_submissions')                              
                     ->where('financial_year', '=', $year_id)
					   ->where('unit_id','=', $unit_id)
                     ->sum('quarter_2');
					 					 		
	 } 
	  //unit quarter three total by revenue category and financial year
	 public static function total_quarter3($category_id,$year_id,$unit_id){
		 
		 return  DB::table('tfs_submissions')
                    
                     ->where('category_id', '=', $category_id)
                     ->where('financial_year', '=', $year_id)
					   ->where('unit_id','=', $unit_id)
                     ->groupBy('category_id')
                     ->sum('quarter_3');
					 					 		
	 } 
	 
	  //unit quarter three grand total by financial year
	 public static function grand_total_quarter3($year_id,$unit_id){
		 
		 return  DB::table('tfs_submissions')
                     ->where('financial_year', '=', $year_id)
					   ->where('unit_id','=', $unit_id)
                     ->sum('quarter_3');
					 					 		
	 }
	
	 //unit quarter four total by revenue category and financial year
	 public static function total_quarter4($category_id,$year_id,$unit_id){
		 
		 return  DB::table('tfs_submissions')
                    
                     ->where('category_id', '=', $category_id)
                     ->where('financial_year', '=', $year_id)
					   ->where('unit_id','=', $unit_id)
                     ->groupBy('category_id')
                     ->sum('quarter_4');
					 					 		
	 } 
	 
	  //unit quarter four grand total by  financial year
	 public static function grand_total_quarter4($year_id,$unit_id){
		 
		 return  DB::table('tfs_submissions')                    
                     ->where('financial_year', '=', $year_id)
					   ->where('unit_id','=', $unit_id)
                     ->sum('quarter_4');
					 					 		
	 }
	 #endregion Unit level query
	 
	 
	 #region Zone level query
	 
	  //unit revenue by revenue category and financial year
	 public static function zone_revenue($category_id,$year_id,$zone_id){
		 
		 return Submission::where('category_id','=', $category_id)
                            ->where('zone_id','=', $zone_id)
                            ->where('financial_year', '=', $year_id)
							->groupBy('item_code')
                            ->get(array(DB::raw('item_code, type_of_fee, sum(total_revenue) as total_revenue, sum(quarter_1) as quarter_1, sum(quarter_2) as quarter_2, sum(quarter_3) as quarter_3, sum(quarter_4) as quarter_4')));
	 }

	
	  //unit total revenue by revenue category and financial year
	 public static function zone_total_revenue($category_id,$year_id,$zone_id){
		 
		 return  DB::table('tfs_submissions')
                    
                     ->where('category_id', '=', $category_id)
                     ->where('financial_year', '=', $year_id)
					 ->where('zone_id','=', $zone_id)
                     ->groupBy('category_id')
                     ->sum('total_revenue');
					 					 		
	 }
 //unit grand revenue by financial year
	 public static function zone_grand_total_revenue($year_id,$zone_id){
		 
		 return  DB::table('tfs_submissions')                   
                     ->where('financial_year', '=', $year_id)
					   ->where('zone_id','=', $zone_id)
                     ->sum('total_revenue');
					 					 		
	 }
	  //unit total quarter one by revenue category and financial year
	 public static function zone_total_quarter1($category_id,$year_id,$zone_id){
		 
		 return  DB::table('tfs_submissions')
                    
                     ->where('category_id', '=', $category_id)
                     ->where('financial_year', '=', $year_id)
					   ->where('zone_id','=', $zone_id)
                     ->groupBy('category_id')
                     ->sum('quarter_1');
					 					 		
	 } 
 //unit quarter one grand total by financial year
	 public static function zone_grand_total_quarter1($year_id,$zone_id){
		 
		 return  DB::table('tfs_submissions')               
                     ->where('financial_year', '=', $year_id)
					  ->where('zone_id','=', $zone_id)
                     ->sum('quarter_1');
					 					 		
	 } 
	 //unit total quarter two by revenue category and financial year
	 public static function zone_total_quarter2($category_id,$year_id,$zone_id){
		 
		 return  DB::table('tfs_submissions')
                    
                     ->where('category_id', '=', $category_id)
                     ->where('financial_year', '=', $year_id)
					   ->where('zone_id','=', $zone_id)
                     ->groupBy('category_id')
                     ->sum('quarter_2');
					 					 		
	 } 
   //unit quarter two grand total by revenue category and financial year
	 public static function zone_grand_total_quarter2($year_id,$zone_id){
		 
		 return  DB::table('tfs_submissions')                              
                     ->where('financial_year', '=', $year_id)
					   ->where('zone_id','=', $zone_id)
                     ->sum('quarter_2');
					 					 		
	 } 
	  //unit quarter three total by revenue category and financial year
	 public static function zone_total_quarter3($category_id,$year_id,$zone_id){
		 
		 return  DB::table('tfs_submissions')
                    
                     ->where('category_id', '=', $category_id)
                     ->where('financial_year', '=', $year_id)
					   ->where('zone_id','=', $zone_id)
                     ->groupBy('category_id')
                     ->sum('quarter_3');
					 					 		
	 } 
	 
	  //unit quarter three grand total by financial year
	 public static function zone_grand_total_quarter3($year_id,$zone_id){
		 
		 return  DB::table('tfs_submissions')
                     ->where('financial_year', '=', $year_id)
					   ->where('zone_id','=', $zone_id)
                     ->sum('quarter_3');
					 					 		
	 }
	
	 //unit quarter four total by revenue category and financial year
	 public static function zone_total_quarter4($category_id,$year_id,$zone_id){
		 
		 return  DB::table('tfs_submissions')
                    
                     ->where('category_id', '=', $category_id)
                     ->where('financial_year', '=', $year_id)
					   ->where('zone_id','=', $zone_id)
                     ->groupBy('category_id')
                     ->sum('quarter_4');
					 					 		
	 } 
	 
	  //unit quarter four grand total by  financial year
	 public static function zone_grand_total_quarter4($year_id,$zone_id){
		 
		 return  DB::table('tfs_submissions')                    
                     ->where('financial_year', '=', $year_id)
					   ->where('zone_id','=', $zone_id)
                     ->sum('quarter_4');
					 					 		
	 }
	 #endregion Zone level query


    public function classes(){
        return $this->hasMany('SubmissionClass');
    }
}