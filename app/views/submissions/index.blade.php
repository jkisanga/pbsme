@extends('action.layouts.default')

@section('content')
<div class="col-lg-12">
<div class="x_panel">
                  <div class="x_title">
                <h2>  REVENUE PROJECTION FOR FINANCIAL YEAR <b>{{$financial_year->year}}</b> FOR  <b>{{Auth::user()->unit->name}}</b> UNIT</h2> @if($unit_submited)<label class="label label-success pull-right">Submitted</label>@endif
                 <div class="clearfix"></div>
                  </div>
                        <div class="x_content">
                            @if( isset($submissions) && count($submissions) > 0)
                                <table class="table table-hover table-striped jambo_table bulk_action dt">
                                    <thead>
                                    <tr>
                                        <th>Item Code</th>
                                        <th>Description of Revenue </th>
                                        <th>Royalty </th>
                                        <th>Taff</th>
                                        <th>VAT</th>
                                        <th>CESS</th>
                                        <th>LMDA</th>
                                        <th>Tree</th>
										 @if(!$unit_submited)

                                        <th class="col-lg-1">Action</th>
										@endif
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($items as $value)
                                    <tr>
                                    <th></th>
                                    <th colspan="8">{{$value->name}}</th>

                                    </tr>
                                      @foreach(Submission::unit_revenue($value->id,$financial_year->id,Auth::user()->unit_id) as $item)
                             <tr>
								<td>{{$item->item_code}}</td>
								<td>{{$item->type_of_fee}}</td>
								<td>{{String::formatMoney($item->royalty)}}</td>
								<td>{{String::formatMoney($item->taff)}}</td>
								<td>{{String::formatMoney($item->vat)}}</td>
								<td>{{String::formatMoney($item->cess)}}</td>
								<td>{{String::formatMoney($item->lmda)}}</td>
								<td>{{String::formatMoney($item->tree)}}</td>

										@if(!$unit_submited)
									
                                       {{--<td><a href="{{URL::to('submissions/show/'. $item->id)}}" title="Click to View Full Detail">...</a></td>--}}
                                       <td class="col-lg-1"><a href="{{URL::to('submissions/edit/'. $item->id)}}" class="btn btn-xs btn-success"><i class="fa fa-bar-chart-o"></i> Fill</a> </td>
										 @endif
                                        </tr>

                                      @endforeach
									  
									  <tr>
										  <th></th>


                            <th class="text-right">Sub Total</th>
				
                            <th>{{String::formatMoney(Submission::unit_royality($value->id,$financial_year->id,$unit->id))}}</th>
                            <th>{{String::formatMoney(Submission::unit_taff($value->id,$financial_year->id,$unit->id))}}</th>
                            <th>{{String::formatMoney(Submission::unit_vat($value->id,$financial_year->id,$unit->id))}}</th>
                            <th>{{String::formatMoney(Submission::unit_cess($value->id,$financial_year->id,$unit->id))}}</th>
                            <th>{{String::formatMoney(Submission::unit_lmda($value->id,$financial_year->id,$unit->id))}}</th>
                            <th>{{String::formatMoney(Submission::unit_tree($value->id,$financial_year->id,$unit->id))}}</th>
									  </tr>
                                    @endforeach
                                  	     <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            </tr>
                            <tr>
                            <td></td>
                            <th  class="text-right">Grand Total</th>

                            <th>{{String::formatMoney(Submission::unit_total_royality($financial_year->id,$unit->id))}}</th>
                            <th>{{String::formatMoney(Submission::unit_total_taff($financial_year->id,$unit->id))}}</th>
                            <th>{{String::formatMoney(Submission::unit_total_vat($financial_year->id,$unit->id))}}</th>
                            <th>{{String::formatMoney(Submission::unit_total_cess($financial_year->id,$unit->id))}}</th>
                            <th>{{String::formatMoney(Submission::unit_total_lmda($financial_year->id,$unit->id))}}</th>
                            <th>{{String::formatMoney(Submission::unit_total_tree($financial_year->id,$unit->id))}}</th>

                            </tr>
									  
									  </tbody>
                </table>
				
				@else
                <div class="col-xs-12">
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <h4 class="text-center">No Data for <b>{{$financial_year->year}}</b> in {{Auth::user()->unit->name}} Unit. Please click the Button to Import</h4>
                <br>
                <div class="text-center">
                  <a  href="{{URL::to('submissions/import_references')}}" class="btn btn-success"><i class="fa fa-credit-card"></i> Import</a>
               </div>
               <br>
               <br>
               <br>
               <br>
               <br>
               <br>
               <br>
                </div>
                @endif
                </div>
                </div>
                </div>

@stop