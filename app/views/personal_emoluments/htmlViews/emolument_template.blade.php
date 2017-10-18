   <style>
   	table{
   	    font-family: "verdana", "sans-serif";
   	}
    </style>

   <table border="1" cellspacing=1, cellpadding=3>
                            <thead>
                            {{--<tr>--}}
                                {{--<th></th>--}}
                                {{--<th></th>--}}
                                {{--<th></th>--}}
                                {{--<th> {{$financialYear}}/{{$financialYear+1}}</th>--}}
                                {{--<th>{{$financialYear-1}}/{{$financialYear}}</th>--}}
                                {{--<th>{{$financialYear-1}}/{{$financialYear}}</th>--}}
                                {{--<th>{{$financialYear-1}}/{{$financialYear}}</th>--}}
                                {{--<th>{{$financialYear}}/{{$financialYear+1}}</th>--}}
                                {{--<th>{{$financialYear+1}}/{{$financialYear+2}}</th>--}}

                            {{--</tr>--}}
                             <tr>
                                <th>CODE_NO</th>
                                <th>DESIGNATION</th>
                                <th>SALARY_SCALE</th>
                                <th>ESTABLISHED_MANNING_LEVEL </th>
                                <th>ACTUAL_STRENGTH </th>
                                <th>APPROVED_ESTABLISH</th>
                                <th>APPROVED_ESTIMATES</th>
                                <th>APPROVED_ESTABLISH </th>
                                <th>APPROVED_ESTIMATES</th>

                            </tr>

                            </thead>
                            <tbody>
                            @foreach($items as $item)
                             <tr>
                            <td>{{$item->code_no}}</td>
                            <td>{{$item->designation}}</td>
                            <td>{{$item->salary_scale}}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            </tr>
                            @endforeach
                            </tbody>
                            </table>