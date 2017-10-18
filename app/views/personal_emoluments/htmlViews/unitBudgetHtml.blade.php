														
 <style>
	table{
	    font-family: "verdana", "sans-serif";
	}
 </style>
 
 <table border="1" cellspacing=2, cellpadding=5>
    <tr>
        <td colspan="8" style="text-align:center"><h2>{{$unit->description}}- For the Year {{$financialYear->year}}/{{$financialYear->year+1}}</h2></td>
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
	<tbody>
		@foreach($objectives as $objective)
		<tr>
			<td colspan="5"><b>OBJECTIVE {{$objective->ob_code}} : {{$objective->ob_description}}</b></td>
		</tr>

		@foreach($objective->target as $targets)
		<tr>
			<td colspan="5" class="active"><b>TARGET {{$targets->target_no}} : {{$targets->ta_description}}</b></td>
		</tr>
			@foreach($targets->activities as $activity)		
		<tr rowspan="4">
			<td>{{$activity->activity_no}}</td>
			<td colspan="1">{{$activity->a_description}}</td>
			<td colspan="6">
			
					@foreach($activity->items as $input)
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