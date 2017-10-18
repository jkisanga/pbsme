          

                        @if( isset($items) && count($items) > 0)
                             <h4>PROJECTION OF REVENUE COLLECTION FOR THE FINANCIAL YEAR <b>{{$financialYear->year}} </b> IN <b>{{$zone->zone_name}} </b> ZONE</h4>
                            <table class="table  table-striped table-bordered" border="1" cellspacing=2 cellpadding=5>
                            <thead>
                            <tr>
                            <th>Item</th>
                            <th>Description of Revenue</th>
                            <th colspan="3">REVENUE PROJECTION {{$financialYear->year}}   (TSHS)</th>
                            <th colspan="2">QUARTERLY PROJECTION  {{$financialYear->year}}  </th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                              
                                <th>T Revenue</th>
                                <th>Quarter I</th>
                                <th>Quarter II</th>
                                <th>Quarter III</th>
                                <th>Quarter IV</th>
                            

                            </tr>

                            </thead>
                            <tbody>
                            @foreach($items as $value)
                            <tr>
                            <th></th>
                            <th colspan="7">{{$value->name}}</th>
                            </tr>
                            @foreach(Submission::zone_revenue($value->id,$financialYear->id,$zone->id) as $item)
                             <tr>
								<td>{{$item->item_code}}</td>
								<td>{{$item->type_of_fee}}</td>
								

								<td>{{String::formatMoney($item->total_revenue)}}</td>
								<td>{{String::formatMoney($item->quarter_1)}}</td>
								<td>{{String::formatMoney($item->quarter_2)}}</td>
								<td>{{String::formatMoney($item->quarter_3)}}</td>
								<td>{{String::formatMoney($item->quarter_4)}}</td>
                            </tr>
                            @endforeach
                            <tr>						                           
                            <th></th>
                            <th>Sub Total</th>
				
                            <th>{{String::formatMoney(Submission::zone_total_revenue($value->id,$financialYear->id,$zone->id))}}</th>
                            <th>{{String::formatMoney(Submission::zone_total_quarter1($value->id,$financialYear->id,$zone->id))}}</th>
                            <th>{{String::formatMoney(Submission::zone_total_quarter2($value->id,$financialYear->id,$zone->id))}}</th>
                            <th>{{String::formatMoney(Submission::zone_total_quarter3($value->id,$financialYear->id,$zone->id))}}</th>
                            <th>{{String::formatMoney(Submission::zone_total_quarter4($value->id,$financialYear->id,$zone->id))}}</th>
     
                            </tr>
                            @endforeach
                            
                            <tr>
                            <td></td>
                            <th>Grand Total</th>

                            <th>{{String::formatMoney(Submission::zone_grand_total_revenue($financialYear->id,$zone->id))}}</th>
                            <th>{{String::formatMoney(Submission::zone_grand_total_quarter1($financialYear->id,$zone->id))}}</th>
                            <th>{{String::formatMoney(Submission::zone_grand_total_quarter2($financialYear->id,$zone->id))}}</th>
                            <th>{{String::formatMoney(Submission::zone_grand_total_quarter3($financialYear->id,$zone->id))}}</th>
                            <th>{{String::formatMoney(Submission::zone_grand_total_quarter4($financialYear->id,$zone->id))}}</th>

                            </tr>
                            </tbody>
                            </table>

							<br>
                            

                            @else
                            <div class=" form-control alert-warning">No data for the selected year</div>
                             @endif

                           