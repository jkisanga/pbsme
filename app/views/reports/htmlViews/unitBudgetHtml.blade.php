														
 <style>
	table{
	    font-family: "verdana", "sans-serif";
	    border: 1px;
	    border-spacing: 2px;

	}
 </style>
 
                           @if( isset($objectives) && count($objectives) > 0)

                            <table class="table table-hover table-bordered"  border="1" cellspacing=2 cellpadding=5>
                            <thead>
                             <tr>
                                    <th colspan="8" style="text-align:center"><h2>{{$unit->name}}-Budget For Financial Year {{$financialYear->year}}</h2></th>
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
							
							
								
                            @foreach(Target::where('objective_id','=',$objective->id)->orderby('target_no')->get() as $targets)
                             <tr>
                            <td colspan="1" class="active"><b>TARGET {{$targets->target_no}}</b></td>
                            <td colspan="8"><b>{{$targets->ta_description}}</b></td>
                            @foreach($targets->activities as $activity)
                            @if($activity->unit_id == $unit->id && $activity->year_id == $financialYear->id )
                                <tr>
                                <td>{{$activity->activity_no}}</td>
                                <td>{{$activity->a_description}}</td>
                                <td colspan="7">
                                <table class="table table-bordered" border="1" cellspacing=2 >
							
								 @foreach(Item::where('activity_id', '=', $activity->id)->orderby('item_code')->get() as $input)

                                <tbody> <tr>
                                <td cass="success">{{$input->item_code}}</td>
                                <td class="warning">{{$input->input_description}}</td>
                                <td class="danger">{{$input->unit_of_measure}}</td>

                               <td class="active">{{String::formatMoney($input->unit_cost)}}</td>
                               <td class="success">{{String::formatMoney($input->total_unit)}}</td>
                               <td class="warning">{{String::formatMoney($input->cost)}}</td>
                               </tr> </tbody>

                               @endforeach
                               <tr>

                                <th colspan="2">Total activity {{$activity->activity_no}}</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>{{String::formatMoney(Item::activity_total($activity->id,$financialYear->id))}}</th>
                                 </tr>
                               </tr>
                               </table>
                                </td>

                            </tr>
                            </tr>
                            @endif
                            @endforeach
									 	<tr>
							<td></td>
							<td></td>
								<td colspan="2"><b>Total Target {{ $targets->target_no}}</b></td>							
							<td></td>
							<td></td>
							<td></td>
							<td class="success"><b >{{String::formatMoney(Item::target_total($targets->id,$unit->id,$financialYear->id))}}</b></td>
							
							</tr>
                             @endforeach
									<tr>
							<td></td>
							<td></td>
								<td colspan="2"><b>Total Objective {{ $objective->ob_code}}</b></td>							
							<td></td>
							<td></td>
							<td></td>
							<td class="warning"><b >{{String::formatMoney(Item::objective_total($objective->id,$unit->id,$financialYear->id))}}</b></td>
							
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
									<td><b>{{String::formatMoney(Item::unit_grand_total($unit->id,$financialYear->id))}}</b></td>
								</tr>
                            </table>


                     @elseif(isset($selectedObjective))

                            <table class="table table-hover table-bordered"  border="1" cellspacing=2, cellpadding=5>
                            <thead>
                              <tr>
                                <th colspan="8" style="text-align:center"><h2>{{$unit->name}}-Budget For Financial Year {{$financialYear->year}}</h2></th>
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

                            @foreach(Target::where('objective_id','=',$selectedObjective->id)->orderby('target_no')->get() as $targets)
                             <tr>
                            <td colspan="1" class="active"><b>TARGET {{$targets->target_no}}</b></td>
                            <td colspan="8"><b>{{$targets->ta_description}}</b></td>
                            @foreach($targets->activities as $activity)
                            @if($activity->unit_id == $unit->id && $activity->year_id == $financialYear->id )
                                <tr>
                                <td>{{$activity->activity_no}}</td>
                                <td>{{$activity->a_description}}</td>
                                <td colspan="7">
                                <table class="table table-bordered" border="1" cellspacing=2 >

                                @foreach( Item::where('activity_id', '=', $activity->id)->orderby('item_code')->get() as $input)

                                <tbody> <tr>
                                <td class="success">{{$input->item_code}}</td>
                                <td class="warning">{{$input->input_description}}</td>
                                <td class="danger">{{$input->unit_of_measure}}</td>

                               <td class="active">{{String::formatMoney($input->unit_cost)}}</td>
                               <td class="success">{{String::formatMoney($input->total_unit)}}</td>
                               <td class="warning">{{String::formatMoney($input->cost)}}</td>
                               </tr> </tbody>

                               @endforeach
                               <tr>

                                <th colspan="2">Total activity {{$activity->activity_no}} </th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>{{String::formatMoney(Item::activity_total($activity->id,$financialYear->id))}}</th>
                                 </tr>
                               </tr>
                               </table>
                                </td>

                            </tr>
                            </tr>
                            @endif
                            @endforeach
							
							<tr>
							<td></td>
							<td></td>
								<td colspan="2"><b>Total Target {{ $targets->target_no}}</b></td>							
							<td></td>
							<td></td>
							<td></td>
							<td class="success"><b>{{String::formatMoney(Item::target_total($targets->id,$unit->id,$financialYear->id))}}</b></td>
							
							</tr>
                             @endforeach

                            </tbody>
							<tr>
									<td></td>
									<td></td>
										<td colspan="2"><b>Total Objective {{ $selectedObjective->ob_code}}</b></td>							
									<td></td>
									<td></td>
									<td></td>
									<td class="warning"><b>{{String::formatMoney(Item::objective_total($selectedObjective->id,$unit->id,$financialYear->id))}}</b></td>
									
							</tr>	

							<tr>
									<td></td>
									<td></td>
										<td colspan="2"><b>Grand Total</b></td>							
									<td></td>
									<td></td>
									<td></td>
									<td><b>{{String::formatMoney(Item::unit_grand_total($unit->id,$financialYear->id))}}</b></td>
									
							</tr>
							
                            </table>


                            @else
                            <div class=" form-control alert-warning">No data for the selected year</div>
                             @endif
