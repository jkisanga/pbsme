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
							@foreach($zoneUnits as $unit)
								{{Str::upper($unit->name)}}|
							@endforeach
						 </div>
					  </div><hr>
					   <div class="row">
						 <div class="col-md-4">Units Submitted Budget <span class="badge badge-success">{{count($unitsSubmittedBudget)}}</span> </div>
						 <div class="col-md-8">
							@foreach($unitsSubmittedBudget as $unit)
								{{Str::upper($unit->name)}}|
							@endforeach
						 </div>
					  </div><hr>

					   <div class="row">
						 <div class="col-md-4">Units Not Submitted Budget <span class="badge badge-success">{{count($zoneUnits) - count($unitsSubmittedBudget)}}</span> </div>
							  <div class="col-md-4">
							  @if(count($zoneUnits)==count($unitsSubmittedBudget))
								  @if($zone_submited)
									    <div class="alert alert-success">Submitted</div>
									@else
								   <input  type="submit"  class="btn btn-primary" value="Submit"/>
								@endif
							   @else
								   <div class="alert alert-warning">All Units have not submitted</div>
							   @endif
                              </div>
					  </div>
			</div>
		</div>
</form>