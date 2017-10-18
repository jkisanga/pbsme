   <style>
   	table{
   	    font-family: "verdana", "sans-serif";
   	}
    </style>

   <table border="1" cellspacing=2, cellpadding=5>
                            <thead>
                            <tr>
                            <td colspan="9">
                            <b>{{$title}}</b>
                            </td>
                            </tr>
                            <tr>
                                <th>CODE NO</th>
                                <th>DESIGNATION</th>
                                <th>SALARY SCALE</th>
                                <th>ESTABLISHED MANNING LEVEL {{$financialYear}}/{{$financialYear+1}}</th>
                                <th>ACTUAL STRENGTH {{$financialYear-1}}/{{$financialYear}}</th>
                                <th>APPROVED ESTAB {{$financialYear-1}}/{{$financialYear}}</th>
                                <th>APPROVED ESTIMATES {{$financialYear-1}}/{{$financialYear}}</th>
                                <th>APPROVED ESTAB {{$financialYear}}/{{$financialYear+1}}</th>
                                <th>APPROVED ESTIMATES {{$financialYear+1}}/{{$financialYear+2}}</th>

                            </tr>

                            </thead>
                            <tbody>
                            @foreach($items as $item)
                             <tr>
                            <td>{{$item->code_no}}</td>
                            <td>{{$item->designation}}</td>
                            <td>{{$item->salary_scale}}</td>
                            <td>{{$item->established_meaning_level}}</td>
                            <td>{{$item->actual_strength}}</td>
                            <td>{{$item->approved_establishment}}</td>
                            <td>{{String::formatMoney($item->approved_estimate)}}</td>
                            <td>{{String::formatMoney($item->approved_establishment_next)}}</td>
                            <td>{{String::formatMoney($item->approved_estimate_next)}}</td>
                            </tr>
                            @endforeach
                            <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{$establishedMeaningLevelSum}}</td>
                            <td>{{$actualStrengthSum}}</td>
                            <td>{{$approvedEstablishmentSum}}</td>
                            <td>{{String::formatMoney($approvedEstimateSum)}}</td>
                            <td>{{String::formatMoney($approvedEstablishmentNextSum)}}</td>
                            <td>{{String::formatMoney($approvedEstimateNextSum)}}</td>
                            </tr>
                            </tbody>
                            </table>