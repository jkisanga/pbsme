
          

                             @if( isset($items) && count($items) > 0)
                             <h4>PROJECTION OF REVENUE COLLECTION FOR THE FINANCIAL YEAR <b>{{$financialYear->year}} </b> IN <b>{{$unit->name}} </b> UNIT</h4>
                            <table class="table  table-striped table-bordered" border="1" cellspacing=2 cellpadding=5>
                            <thead>
                            <tr>
                            <th>Item</th>
                            <th>Description of Revenue</th>
                            <th colspan="3">REVENUE PROJECTION {{$financialYear->year}}   (TSHS)</th>
                            <th colspan="4">QUARTERLY PROJECTION  {{$financialYear->year}}  </th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th>Unit Price</th>
                                <th>Quantity</th>
                                <th>T Revenue</th>
                                <th>Quarter I</th>
                                <th>Quarter II</th>
                                <th>Quarter III</th>
                                <th>Quarter IV</th>
                                </th>

                            </tr>

                            </thead>
                            <tbody>
                            @foreach($items as $value)
                            <tr>
                            <th></th>
                            <th colspan="8">{{$value->name}}</th>
                            </tr>
                            @foreach(Submission::unit_revenue($value->id,$financialYear->id,$unit->id) as $item)
                             <tr>
								<td>{{$item->item_code}}</td>
								<td>{{$item->type_of_fee}}</td>
								<td>{{String::formatMoney($item->unit_price)}}</td>
								<td>{{$item->quantity}}</td>

								<td>{{String::formatMoney($item->total_revenue)}}</td>
								<td>{{String::formatMoney($item->quarter_1)}}</td>
								<td>{{String::formatMoney($item->quarter_2)}}</td>
								<td>{{String::formatMoney($item->quarter_3)}}</td>
								<td>{{String::formatMoney($item->quarter_4)}}</td>
                            </tr>
                            @endforeach
                            <tr>
						
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>Sub Total</th>
				
                            <th>{{String::formatMoney(Submission::total_revenue($value->id,$financialYear->id,$unit->id))}}</th>
                            <th>{{String::formatMoney(Submission::total_quarter1($value->id,$financialYear->id,$unit->id))}}</th>
                            <th>{{String::formatMoney(Submission::total_quarter2($value->id,$financialYear->id,$unit->id))}}</th>
                            <th>{{String::formatMoney(Submission::total_quarter3($value->id,$financialYear->id,$unit->id))}}</th>
                            <th>{{String::formatMoney(Submission::total_quarter4($value->id,$financialYear->id,$unit->id))}}</th>
     
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
                            <td></td>
                            <td></td>
                            <th>Grand Total</th>

                            <th>{{String::formatMoney(Submission::grand_total_revenue($financialYear->id,$unit->id))}}</th>
                            <th>{{String::formatMoney(Submission::grand_total_quarter1($financialYear->id,$unit->id))}}</th>
                            <th>{{String::formatMoney(Submission::grand_total_quarter2($financialYear->id,$unit->id))}}</th>
                            <th>{{String::formatMoney(Submission::grand_total_quarter3($financialYear->id,$unit->id))}}</th>
                            <th>{{String::formatMoney(Submission::grand_total_quarter4($financialYear->id,$unit->id))}}</th>

                            </tr>
							 <tr>
                            <th></th>
                            <th colspan="8">Other Collections</th>
                            </tr>
							<tr>
							<td></td>
                            <td colspan="1"> VAT</td> 
							<td>{{String::formatMoney(Submission::unit_total_vat($financialYear->id,$unit->id))}}</td>						</tr>
							<tr>
							<td></td>
                            <td colspan="1"> TAFF</td> 
							<td>{{String::formatMoney(Submission::unit_total_taff($financialYear->id,$unit->id))}}</td>						</tr>
							<tr>
							<td></td>
                            <td colspan="1"> CESS</td> 
							<td>{{String::formatMoney(Submission::unit_total_cess($financialYear->id,$unit->id))}}</td>						</tr>
							<tr>
							<td></td>
                            <td colspan="1"> LMDA</td> 
							<td>{{String::formatMoney(Submission::unit_total_lmda($financialYear->id,$unit->id))}}</td>						</tr>
								<tr>
							<td></td>
                            <td colspan="1"> TREE</td> 
							<td>{{String::formatMoney(Submission::unit_total_tree($financialYear->id,$unit->id))}}</td>						</tr>
                            </tbody>
                            </table>
							
							<br>
                           

                            @else
                            <div class=" form-control alert-warning">No data for the selected year</div>
                             @endif

                           