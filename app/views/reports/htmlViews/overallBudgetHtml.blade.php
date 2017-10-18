    <style>
	table{
	    font-family: "verdana", "sans-serif";
	    border: 1px;
	    border-spacing: 2px;

	}
 </style>
    
    @if( isset($objectives) && count($objectives) > 0)

                            <table class="table table-hover table-bordered"  border="1" cellspacing="2" cellpadding="5">
                            <thead>
							 <tr>
                                    <td colspan="9" style="text-align:center"><h2> Budget for financial Year {{$financialYear->year}}</h2></td>
                                </tr>
                            <tr>
                                <th>Performance  Code</th>
                                <th>Activity Description</th>
                                <th>Input Code</th>
                                <th>Input Description</th>
                                <th>Unit of Measure</th>
                                <th>Unit Cost (TZS)</th>
                                <th>No. of Unit</th>
                                <th>Total Cost (TZS)</th>
                            </tr>

                            </thead>
                            <tbody>
                            @foreach($objectives as $objective)
                             <tr>
                            <td colspan="1"><b>OBJECTIVE {{$objective->ob_code}}</b></td>
                            <td colspan="8"><b>{{$objective->ob_description}}</b></td>
                            </tr>

                            @foreach(Target::getTargetByObjective($objective->id) as $target)
                             <tr>
                            <td colspan="1" class="active"><b>TARGET {{$target->target_no}}</b></td>
                            <td colspan="8"><b>{{$target->ta_description}}</b></td>
                          @foreach( ConsolidateActivity::getOverallActivities($target->id,$financialYear->id) as $activity)

                                <tr>
                                  <td>

                                    {{$activity->number}}

                                    </td>
                               <td>

                                   {{$activity->description}}

                                   </td>
                                <td colspan="7">
                                <table class="table table-bordered" border="1" cellspacing="2" cellpadding="5">

                                            @foreach( Item::getOverallItems($activity->id) as $input)

                                            <tbody> <tr>
                                            <td class="success">{{$input->item_code}}</td>
                                            <td class="warning">{{$input->input_description}}</td>
                                            <td class="danger">{{$input->unit_of_measure}}</td>

                                              <td class="active">{{String::formatMoney($input->unit_cost)}}</td>
                                               <td class="success">{{String::formatMoney($input->quantity)}}</td>
                                               <td class="warning">{{String::formatMoney($input->total)}}</td>
                                           </tr> </tbody>


                                           @endforeach

                               <tr>
                                <th colspan="2">Total Activity {{$activity->number}} </th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>								
								
                                {{String::formatMoney(ConsolidatedItem::tfs_activity_total($activity->id))}}

                                 </tr>
                               </tr>
                               </table>
                                </td>

                            </tr>
                            </tr>

                            @endforeach
						<tr>
							<td></td>
							<td></td>
								<td colspan="2"><b>Total Target {{ $target->target_no}}</b></td>							
							<td></td>
							<td></td>
							<td></td>
							<td class="success"><b >{{String::formatMoney(ConsolidatedItem::tfs_target_total($target->id,$financialYear->id))}}</b></td>
							
							</tr>
                             @endforeach
							 	<tr>
							<td></td>
							<td></td>
								<td colspan="2"><b>Total Objective {{ $objective->ob_code}}</b></td>							
							<td></td>
							<td></td>
							<td></td>
							<td class="warning"><b >{{String::formatMoney(ConsolidatedItem::tfs_objective_total($objective->id,$financialYear->id))}}</b></td>
							
							</tr>
                            @endforeach
                           </tbody>
									<tr>
									<td></td>
									<td></td>
										<td colspan="2"><b>Grand Total</b></td>							
									<td></td>
									<td></td>
									<td></td>
									<td><b>{{String::formatMoney(ConsolidatedItem::tfs_grand_total($financialYear->id))}}</b></td>
								</tr>
                            </table>
                             


                     @elseif(isset($selectedObjective))

                            <table class="table table-hover table-bordered"  border="1" cellspacing="2" cellpadding="5">
                            <thead>
							 <tr>
                                    <td colspan="9" style="text-align:center"><h2> Budget for financial Year {{$financialYear->year}}</h2></td>
                                </tr>
                            <tr>
                                <th>Performance  Code</th>
                                <th>Activity Description</th>
                                <th>Input Code</th>
                                <th>Input Description</th>
                                <th>Unit of Measure</th>
                                <th>Unit Cost (TZS)</th>
                                <th>No. of Unit</th>
                                <th>Total Cost (TZS)</th>
                            </tr>

                            </thead>
                            <tbody>

                             <tr>
                            <td colspan="1"><b>OBJECTIVE {{$selectedObjective->ob_code}}</b></td>
                            <td colspan="8"><b>{{$selectedObjective->ob_description}}</b></td>
                            </tr>

                            @foreach(Target::getTargetByObjective($selectedObjective->id) as $target)
                             <tr>
                            <td colspan="1" class="active"><b>TARGET {{$target->target_no}}</b></td>
                            <td colspan="8"><b>{{$target->ta_description}}</b></td>
                             @foreach( ConsolidateActivity::getOverallActivities($target->id,$financialYear->id)as $activity)

                                <tr>
                                  <td>

                                    {{$activity->number}}

                                    </td>
                               <td>

                                   {{$activity->description}}

                                   </td>
                                <td colspan="7">
                                <table class="table table-bordered" border="1" cellspacing=2 >

                                            @foreach( Item::getOverallItems($activity->id) as $input)

                                            <tbody> <tr>
                                            <td class="success">{{$input->item_code}}</td>
                                            <td class="warning">{{$input->input_description}}</td>
                                            <td class="danger">{{$input->unit_of_measure}}</td>

                                              <td class="active">null</td>
                                               <td class="success">{{String::formatMoney($input->quantity)}}</td>
                                               <td class="warning">{{String::formatMoney($input->total)}}</td>
                                           </tr> </tbody>


                                           @endforeach

                               <tr>
                                <th colspan="2">Total Activity {{$activity->number}} </th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>								
								
                                {{String::formatMoney(ConsolidatedItem::tfs_activity_total($activity->id))}}

                                 </tr>
                               </tr>
                               </table>
                                </td>

                            </tr>
                            </tr>

                            @endforeach
						<tr>
							<td></td>
							<td></td>
								<td colspan="2"><b>Total Target {{ $target->target_no}}</b></td>							
							<td></td>
							<td></td>
							<td></td>
							<td class="success"><b >{{String::formatMoney(ConsolidatedItem::tfs_target_total($target->id,$financialYear->id))}}</b></td>
							
							</tr>
                             @endforeach
							 	<tr>
							<td></td>
							<td></td>
								<td colspan="2"><b>Total Objective {{ $selectedObjective->ob_code}}</b></td>							
							<td></td>
							<td></td>
							<td></td>
							<td class="warning"><b >{{String::formatMoney(ConsolidatedItem::tfs_objective_total($selectedObjective->id,$financialYear->id))}}</b></td>
							
							</tr>
                        
                            </tbody>

                            </table>
                            

                            @else
                            <div class=" form-control alert-warning ">No data for the selected year</div>
                             @endif
                             </div>
                      
                 