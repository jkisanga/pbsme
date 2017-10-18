														
 <style>
	table{
	    font-family: "verdana", "sans-serif";
	    border: 1px;
	    border-spacing: 2px;

	}
 </style>
 
                           @if( isset($items) && count($items) > 0)

                            <table class="table table-hover table-bordered"  border="1" cellspacing=2 cellpadding=5>
                            <thead>
                            
                            <tr>
                                <th>Seg 4 (GFS  Code)</th>
                                <th>Seg 4 Description (GFS Code Description)</th>
                                <th>Annual Budget Estimates {{$financialYear->year}}</th>
                                <th>Forward Estimates {{$forward_et1}} (5%)</th>
                                <th>Forward Estimates {{$forward_et2}} (10%)</th>
                                
                            </tr>

                            </thead>
                            <tbody>                            
								 @foreach($items as $input)
                                <td class="success">{{$input->item_code}}</td>
                                <td class="active">{{$input->input_description}}</td>
                                <td class="warning">{{String::formatMoney($input->totalCost)}}</td>
								
								<td class="success">{{String::formatMoney((5/100 *($input->totalCost)) + $input->totalCost)}}</td>
								<td class="warning">{{String::formatMoney((10/100 *($input->totalCost)) + $input->totalCost)}}</td>
                               
                               </tr> </tbody>

                               @endforeach
							   <tr>
							   <td></td>
							   <th>Total</th>
							   <th class="warning">{{String::formatMoney($grandTotalCost)}}</th>
							   <th class="success">{{String::formatMoney($grandTotalCostForwad1)}}</th>
							   <th class="warning">{{String::formatMoney($grandTotalCostForwad2)}}</th>
							   
							   </tr>
                                
                            </table>
                            @else
                            <div class=" form-control alert-warning">No data for the selected year</div>
                             @endif
