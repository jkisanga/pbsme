@extends('action.layouts.default')


@section('content')
<div class="col-lg-12">
                        <div class="panel panel-green">
                            <div class="panel-heading"><small>Note: Click the Emolument to see more detail</small>
                                 <b class="pull-right"><a class="btn btn-primary" href="{{URL::to('form8a/create')}}" >Create</a></b>

                            </div>
                            <div class="panel-body">
                                <table class="table table-hover table-striped table-bordered table-responsive ">
                                    <thead>
                                    <tr>
                         <th>CODE NO</th>
                         <th>DESIGNATION</th>
                         <th>SALARY SCALE</th>
                         <th>SALARY SCALE</th>
                         <th>ESTABLISHED MANNING LEVEL {{$financial_year->year}}/{{$financial_year->year+1}}</th>
                         <th>ACTUAL STRENGTH {{$financial_year->year-1}}/{{$financial_year->year}}</th>
                         <th>APPROVED ESTABLISHMENT {{$financial_year->year-1}}/{{$financial_year->year}}</th>
                         <th>Action</th>
                     </tr>
                     </thead>
                     <tbody>
                     @foreach($items as $item)
                     <tr>
                         <td>{{$item->code_no}}</td>
                         <td>{{$item->designation}}</td>
                         <td>{{$item->salary_scale}}</td>
                         <td>{{$item->established_meaning_level}}</td>
                         <td class="col-lg-2">
                         <div class="dropdown">
                           <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                             Options
                             <span class="caret"></span>
                           </button>
                           <ul class="dropdown-menu " aria-labelledby="dropdownMenu1">
                             <li><a href="{{URL::to('units/edit/'.$item->id)}}" >Edit</a></li>
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