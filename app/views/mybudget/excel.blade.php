  <table border="1" cellspacing=2, cellpadding=5>
	<thead>
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
			<td colspan="5"><b>OBJECTIVE {{$objective->ob_code}} : {{$objective->ob_description}}</b></td>
		</tr>

		@foreach($objective->target as $targets)
		<tr>
			<td colspan="5" class="active"><b>TARGET {{$targets->target_no}} : {{$targets->ta_description}}</b></td>
		</tr>
			@foreach($activities = DB::table('tfs_activities')->where('target_id', '=', $targets->id)->where('unit_id', '=', Auth::user()->unit_id)->get() as $activity)		
		<tr rowspan="4">
			<td>{{$activity->activity_no}}</td>
			<td colspan="1">{{$activity->a_description}}</td>
			<td colspan="6">
			
					@foreach(DB::table('tfs_items')->where('activity_id', '=', $activity->id)->get() as $input)
					<tr>
						<td></td>
						<td></td>
						<td>{{$input->item_code}}</td>
						<td>{{$input->input_description}}</td>
						<td>{{$input->unit_of_measure}}</td>
						<td>{{$input->unit_cost}}</td>
						<td>{{$input->no_of_unit}}</td>
						<td>{{$input->cost}}</td>
						
					</tr> 
					@endforeach
					<tr>
						<td></td>
						<td><b>Total Activity : {{$activity->activity_no}} </b></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td><b>{{$activity->a_budget}}</b></td>
					</tr>
					
			
			</td>

		</tr>
	@endforeach

	 @endforeach
	@endforeach
	</tbody>

	</table>