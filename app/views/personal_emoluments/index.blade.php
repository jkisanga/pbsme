@extends('action.layouts.default')


@section('content')
<div class="col-lg-12">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                        <a class="btn btn-primary" href="{{URL::to('personal_emoluments/create')}}" >Add</a>
                                 <b class="pull-right">
                                 <a class="btn btn-default" href="{{URL::to('personal_emoluments/createExcel')}}" >Upload via Excel</a>
                                 </b>

                            </div>
                            <div class="panel-body">
                                <table class="table table-hover table-striped table-bordered table-responsive ">
                                    <thead>
                                    <tr>
                         <th>DESIGNATION</th>
                         <th>ESTAB MANNING LEVEL {{$financial_year->year}}/{{$financial_year->year+1}}</th>
                         <th>ACTUAL STRENGTH {{$financial_year->year-1}}/{{$financial_year->year}}</th>
                         <th>APPROVED ESTAB {{$financial_year->year-1}}/{{$financial_year->year}}</th>
                          <th>APPROVED ESTIMATES {{$financial_year->year-1}}/{{$financial_year->year}}</th>
                         <th>APPROVED ESTAB {{$financial_year->year}}/{{$financial_year->year+1}}</th>
                         <th>APPROVED ESTIMATES {{$financial_year->year+1}}/{{$financial_year->year+2}}</th>
                         <th>Action</th>
                     </tr>
                     </thead>
                     <tbody>
                     @foreach($items as $item)
                     <tr>
                         <td>{{$item->designation}}</td>
                         <td>{{$item->established_meaning_level}}</td>
                         <td>{{$item->actual_strength}}</td>
                         <td>{{$item->approved_establishment}}</td>
                         <td>{{String::formatMoney($item->approved_estimate) }}</td>
                         <td>{{String::formatMoney($item->approved_establishment_next)}}</td>
                         <td>{{String::formatMoney($item->approved_estimate_next)}}</td>
                         <td class="col-lg-2">
                         <div class="dropdown">
                           <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                             Options
                             <span class="caret"></span>
                           </button>
                           <ul class="dropdown-menu " aria-labelledby="dropdownMenu1">
                             <li><a href="{{URL::to('personal_emoluments/remarks/'.$item->id)}}" >Remarks</a></li>
                             <li><a href="{{URL::to('personal_emoluments/edit/'.$item->id)}}" >Edit</a></li>
		          <li><a href="{{{ URL::to('units/delete/'.$item->id)}}}" onclick="return confirm('Are you sure?')" >Delete</a></li>

                      </ul>
                     </div></td></tr>
                     @endforeach
                    </tbody>
                                    </table>
                                    </div>
                                    </div>
                                    </div>


                    @stop
                    {{-- Scripts --}}
                    @section('scripts')
                    	<script type="text/javascript">
                    		var oTable;
                    		$(document).ready(function() {
                    			oTable = $('.table').dataTable( {

                    			});
                    		});
                    	</script>
                    @stop