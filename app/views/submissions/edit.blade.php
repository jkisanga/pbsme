@extends('action.layouts.default')
@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                      <div class="x_title">
              <h2>Revenue Projection Form</h2>
              <a href="{{URL::to('submissions/index')}}" class="btn btn-sm btn-warning pull-right"><i class="fa fa-backward"></i></a>
                                <div class="clearfix"></div>

                </div>
                <div class="x_content"><div class="x_panel" style="color: #515356">
               <h2>    {{$submission->item_code}} : {{$submission->type_of_fee}}</h2>
               </div>
                 <div class="row tile_count">
                            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                              <span class="count_top"> Grand Royalty</span>
                              <div class="count grand_royalty"  id="grand_royalty"  >{{Input::old('total_revenue',$submission->total_revenue)}}</div>
                              <span class="count_bottom"><i class="green">100% </i> </span>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                              <span class="count_top"> Royalty</span>
                              <div class="count royalty_p">{{Input::old('royalty',String::formatMoney($submission->royalty))}}</div>
                              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>{{$submission->percent_royalty}}% </i> </span>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                              <span class="count_top"> TaFF</span>
                              <div class="count taff_v ">{{Input::old('taff',$submission->taff)}}</div>
                              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>{{$submission->percent_taff}}% </i> </span>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                              <span class="count_top"> VAT</span>
                              <div class="count vat_v">{{Input::old('vat',$submission->vat)}}</div>
                              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>{{$submission->percent_vat}}% </i> </span>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                              <span class="count_top"> CESS</span>
                              <div class="count cess_v">{{Input::old('cess',$submission->cess)}}</div>
                              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>{{$submission->percent_cess}}% </i> </span>
                            </div>
                            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                              <span class="count_top">LMDA</span>
                              <div class="count lmda_v">{{Input::old('lmda',$submission->lmda)}}</div>
                              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>
                              @if($submission->percent_lmda < 100)
                              {{$submission->percent_lmda}}%
                              @else
                              {{String::formatMoney($submission->percent_lmda)}} TZS
                              @endif
                               </i> </span>
                            </div>
                          </div>

                   <form action="{{URL::to('submissions/update/'. $submission->id)}}" method="post">
				     <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                        <table class="table">

                        <thead>
                        <th>Classes</th>
                        <th>Rate</th>
                        <th>Volume</th>
                        <th>Grand Royalty</th>
                        <th>Royalty</th>
                        <th>Taff</th>
                  
                        </thead>
                        <tbody>
						
						<span>
                        @foreach(SubmissionClass::where('submission_id', '=',$submission->id)->get() as $value)
                        <tr class="txtMult">
                        <td><input name="dbh[]" type="text" value="{{$value->class}}" class="form-control class dbh" readonly /></td>
                        <td><input name="rate[]" type="text" value="@if($value->rate != 0){{Input::old('rate[]',$value->rate)}} @else @endif" class="form-control rate"  /></td>
                        <td><input name="volume[]" type="text" value="@if($value->volume != 0){{Input::old('volume[]',$value->volume)}} @else @endif" class="form-control volume" /></td>
                        <td><input name="groyality[]" type="text" value="@if($value->grand_royalty != 0){{Input::old('groyality[]',$value->grand_royalty)}} @else @endif" class="form-control groyality" readonly /></td>
                        <td><input name="croyality[]" type="text" value="@if($value->royalty != 0){{Input::old('croyality[]',$value->royalty)}} @else @endif" class="form-control royality" readonly /></td>
                        <td><input name="ctaff[]" type="text" value="@if($value->taff != 0){{Input::old('ctaff[]',$value->taff)}} @else @endif" class="form-control taff" readonly /></td>

                        </tr>
                        @endforeach
						</span>
                
                        </tbody>
                        </table>
                              <div class="row"><div class="col-xs-6">
                                          <h4 class="center">QUARTERLY PROJECTION {{$currentYear->year}}</h4>
                                          </div>
                                           <div class="col-xs-1"></div>
                                                      <div class="col-xs-3">
                                                      <div class="row top_tiles">
                                                  <div class="tile">
                                                    <span>Grand Total</span>
                                                    <h2 class="green royalty_p"></h2>
                                                  </div>
                                                  </div>
                                                      </div>
                                                <div class="col-xs-2">
                                                      <div class="row top_tiles" >
                                                  <div class="tile">
                                                    <span>Balance</span>
                                                    <h2 class="balance"></h2>
                                                  </div>
                                                  </div>
                                                      </div>
                                                </div>

                                           <div class="row">
                                          <div class="col-xs-3"><label>Quarter I</label>
                                            <input type="text" class="form-control division" name="quarter_1" value="@if($submission->quarter_1 != 0){{Input::old('quarter_1',$submission->quarter_1)}} @else @endif">
                                          </div>
                                          <div class="col-xs-3"><label>Quarter II</label>
                                            <input type="text" class="form-control division" name="quarter_2" value="@if($submission->quarter_2 != 0){{Input::old('quarter_2',$submission->quarter_2)}} @else @endif">
                                          </div>
                                          <div class="col-xs-3"><label>Quarter III</label>
                                            <input type="text" class="form-control division" name="quarter_3" value="@if($submission->quarter_3 != 0){{Input::old('quarter_3',$submission->quarter_3)}} @else @endif" >
                                          </div>
                                          <div class="col-xs-3"><label>Quarter IV</label>
                                            <input type="text" class="form-control division" name="quarter_4" value="@if($submission->quarter_4 != 0){{Input::old('quarter_4',$submission->quarter_4)}} @else @endif">
                                          </div>

                                              <div class="form-group">
                                                <div class="col-md-12 col-sm-9 col-xs-12"><br>
                                                  <a href="{{URL::to('submissions/index')}}" class="btn btn-default">Cancel</a>
                                                  <button type="submit" class="btn-sm btn btn-info pull-right">Post </button>
                                                </div>
                                              </div>
                                             </div>
											 
											 
        <input name="total_revenue" type="hidden" class="form-control grand_royalty"    value="{{Input::old('total_revenue',$submission->total_revenue)}}" />
        <input name="royalty" type="hidden" class="form-control royalty_p"    value="{{Input::old('royalty',$submission->royalty)}}" />
        <input type="hidden" class="form-control" id="royalty_p_v"   value="{{$submission->percent_royalty}}" />


        <input  name="taff"  type="hidden" class="form-control taff_v"   value="{{Input::old('taff',$submission->taff)}}" />
        <input type="hidden" class="form-control" id="taff_p_v"   value="{{$submission->percent_taff}}" />

        <input  name="vat"  type="hidden" class="form-control vat_v"   value="{{Input::old('vat',$submission->vat)}}" />
        <input type="hidden" class="form-control" id="vat_p_v"   value="{{$submission->percent_vat}}" />

         <input  name="cess"  type="hidden" class="form-control cess_v"   value="{{Input::old('cess',$submission->cess)}}" />
        <input type="hidden" class="form-control" id="cess_p_v"   value="{{$submission->percent_cess}}" />

         <input  name="lmda"  type="hidden" class="form-control lmda_v"   value="{{Input::old('lmda',$submission->lmda)}}" />
        <input type="hidden" class="form-control" id="lmda_p_v"   value="{{$submission->percent_lmda}}" />

         <input  name="tree"  type="hidden" class="form-control tree_v"   value="{{Input::old('tree',$submission->tree)}}" />
        <input type="hidden" class="form-control" id="tree_p_v"   value="{{$submission->percent_tree}}" />
                       </form>
                
</div>
</div>
</div>
</div>
 @stop
 
 @section('scripts')
 
 <script>
     $(document).ready(function(){

         //iterate through each textboxes and add keyup
         //handler to trigger sum event
         $(".revenue").each(function() {

             $(this).keyup(function(){
                 calculateSum();

             });
         });

         $(".division").each(function() {

             $(this).keyup(function(){
				 
				 //return alert("here");
                 calculateSub();
             });
         });

     });

     function calculateSum() {

         var sum = 1;
         var royalty =1;
         //iterate through each textboxes and add the values
         $(".revenue").each(function() {

             //add only if the value is number
             if(!isNaN(this.value) && this.value.length!=0) {

             //sum = sum * this.value;
                 sum = sum * parseFloat(this.value);
                 calculateRoyalty(sum);
                 calculateTaFF(sum);
                 calculateCESS(sum);
             }

         });
         //.toFixed() method will roundoff the final sum to 2 decimal places
         $(".grand_royalty").val(sum.toFixed(2));
         $(".grand_royalty").html(sum.toFixed(2));


     }

     function calculateRoyalty(sum) {

         var royalty = 1;
         //iterate through each textboxes and add the values
         $("#royalty_p_v").each(function() {

             //add only if the value is number
             if(!isNaN(this.value) && this.value.length!=0) {

             //sum = sum * this.value;
                 royalty = parseFloat(this.value)/100 * sum;
                 calculateVAT(royalty);
             }

         });
         //.toFixed() method will roundoff the final sum to 2 decimal places
         $(".royalty_p").val(royalty.toFixed(2));
         $(".royalty_p").html(royalty.toFixed(2));
     }
     //
     function calculateTaFF(sum) {

         var taff = 1;
         //iterate through each textboxes and add the values
         $("#taff_p_v").each(function() {

             //add only if the value is number
             if(!isNaN(this.value) && this.value.length!=0) {

             //sum = sum * this.value;
                 taff = parseFloat(this.value)/100 * sum;
             }

         });
         //.toFixed() method will roundoff the final sum to 2 decimal places
         $(".taff_v").val(taff.toFixed(2));
         $(".taff_v").html(taff.toFixed(2));
     } //

     function calculateVAT(royalty) {

         var vat = 1;
         //iterate through each textboxes and add the values
         $("#vat_p_v").each(function() {

             //add only if the value is number
             if(!isNaN(this.value) && this.value.length!=0) {

             //sum = sum * this.value;
                 taff = parseFloat(this.value)/100 * royalty;
             }

         });
         //.toFixed() method will roundoff the final sum to 2 decimal places
         $(".vat_v").val(taff.toFixed(2));
         $(".vat_v").html(taff.toFixed(2));
     }

     function calculateCESS(sum) {

         var cess = 1;
         //iterate through each textboxes and add the values
         $("#cess_p_v").each(function() {

             //add only if the value is number
             if(!isNaN(this.value) && this.value.length!=0) {

             //sum = sum * this.value;
                 cess = parseFloat(this.value)/100 * sum;
             }

         });
         //.toFixed() method will roundoff the final sum to 2 decimal places
         $(".cess_v").val(cess.toFixed(2));
         $(".cess_v").html(cess.toFixed(2));
     }

     function calculateLMDA(sum) {

         var lmda = 1;
         //iterate through each textboxes and add the values
         $("#lmda_p_v").each(function() {

             //add only if the value is number
             if(!isNaN(this.value) && this.value.length!=0) {

             //sum = sum * this.value;
                 taff = parseFloat(this.value)/100 * sum;
             }

         });
         //.toFixed() method will roundoff the final sum to 2 decimal places
         $(".lmda_v").val(taff.toFixed(2));
         $(".mlda_v").html(taff.toFixed(2));
     }


     function calculateSub() {

         var sum = $('.royalty_p').val();
         var remain = sum;
         //iterate through each textboxes and add the values
         $(".division").each(function() {

             //add only if the value is number
             if(!isNaN(this.value) && this.value.length!=0){
                   remain -= parseFloat(this.value);
             }

         });
         //.toFixed() method will roundoff the final sum to 2 decimal places
         $(".balance").val(remain);
		  $(".balance").text(remain);
    
     }


     //calculate classes
	 

			
      $(".txtMult input").keyup(multInputs);

       function multInputs() {
           var gtotal = 0;
		   var tvolume = 0;
		   
           // for each row:
           $("tr.txtMult").each(function () {
               // get the values from this row:
               var $rate = $('.rate', this).val();
               var $volume = $('.volume', this).val();
               var $total = ($rate * 1) * ($volume * 1)	
			   
               $('.groyality',this).val($total);
			   var royality = parseFloat($('#royalty_p_v').val() * 0.01 * $total);
			   var taff = parseFloat($('#taff_p_v').val() * 0.01 * $total);
			  			 
			   
			   $('.royality',this).val(royality.toFixed(2));
			   $('.taff',this).val(taff.toFixed(2));
			   
			  
               tvolume += $volume * 1;
               gtotal += $total;
           });
           $(".grand_royalty").text(gtotal.toFixed(2));
           $(".grand_royalty").val(gtotal.toFixed(2));
		   
		     var totalVolume = parseFloat($('#lmda_p_v').val() * tvolume);
			 $(".lmda_v").text(totalVolume.toFixed(2));
			 $(".lmda_v").val(totalVolume.toFixed(2));

		     calculateRoyalty(gtotal);
             calculateTaFF(gtotal);
             calculateCESS(gtotal);
		     
       }

 </script>
 @stop