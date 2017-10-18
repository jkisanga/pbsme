 @if(isset($budgets))
           <table class="table table-hover table-bordered"  border="1" cellspacing="2", cellpadding="5">
    		<thead>
			 <tr>
				<td colspan="7" style="text-align:center"><h2>Budget Summary Per Unit for {{$zone->zone_name}}  For Financial Year {{$financialYear->year}}</h2></td>
			</tr>
    			<tr>
    				<th class="col-md-2">STATION</th>
    				<th>OBJECTIVE A</th>
    				<th>OBJECTIVE B</th>
    				<th>OBJECTIVE C</th>
    				<th>OBJECTIVE D</th>
    				<th>OBJECTIVE E</th>
    				<th>TOTAL</th>
    			</tr>
    		</thead>

    		<tbody>
    		    @foreach($budgets as $budget)
    		    <tr>
    		           <td>{{$budget->unit}}</td>
    		           <td>{{String::formatMoney($budget->OBJECTIVEA)}}</td>
    		           <td>{{String::formatMoney($budget->OBJECTIVEB)}}</td>
    		           <td>{{String::formatMoney($budget->OBJECTIVEC)}}</td>
    		           <td>{{String::formatMoney($budget->OBJECTIVED)}}</td>
    		           <td>{{String::formatMoney($budget->OBJECTIVEE)}}</td>
    		           <td style="background-color: #2aabd2">
    		             <b>{{String::formatMoney($budget->OBJECTIVEA+$budget->OBJECTIVEB+$budget->OBJECTIVEC+$budget->OBJECTIVED+$budget->OBJECTIVEE)}}</b>
    		           </td>

    		   </tr>
    		   @endforeach

					<tr>
						<th>Total</th>
						<th>{{String::formatMoney($objA)}}</th>
						<th>{{String::formatMoney($objB)}}</th>
						<th>{{String::formatMoney($objC)}}</th>
						<th>{{String::formatMoney($objD)}}</th>
						<th>{{String::formatMoney($objE)}}</th>
						<th>{{String::formatMoney($total)}}</th>
					</tr>		
    		 </tbody>
    		 </table>
        @endif