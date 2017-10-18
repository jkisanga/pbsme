  <form action="{{URL::to('budget/zone_submit')}}" method="post">
	 <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
       <input  type="hidden"  name="year_id" class="form-control" value="{{$financial_year->id}}" /> 
		<div class="panel panel-default">
			<div class="panel-heading">
				<h5>{{$unit->zone}} ({{$unit->initial}}) </h5>
			</div>

			<div class="panel-body">

			 <div class="row">
						 <div class="col-md-4">Total Number of Units <span class="badge badge-success">{{count($zoneUnits)}}</span> </div>
						 <div class="col-md-8">
							Units Submitted Report
						 </div>
					  </div><hr>
					   <div class="row">
						 <div class="col-md-4">  </div>
						 <div class="col-md-8">
							<table class="table table-bordered">
							<thead>
								<tr>
									<th>Unit</th>
									<th>Quarter</th>
									<th>submited By</th>
								</tr>
							</thead>
							</tbody>
							@foreach($zoneUnits as $unit)
								<tr>
									<td>{{Str::upper($unit->name)}}</td>
									<td colspan="2">
									<table class="table" width="100%">
										@foreach($unitsSubmitted as $report)
										   @if($report->name == $unit->name)
											<tr>
												<td>{{Str::upper($report->quarter)}}</td>
												<td>{{Str::upper($report->first_name)}}  {{Str::upper($report->last_name)}}  <a href="{{URL::to('kpiEvaluation/unlock',$report->kid)}}" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-primary pull-right">Unlock</a></td>
											</tr>
											@endif
										@endforeach
										</table>
									</td>
								</tr>
							@endforeach
							</tbody>
							</table>
						 </div>
					  </div><hr>

			</div>
		</div>
</form>