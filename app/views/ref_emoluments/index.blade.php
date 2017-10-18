@extends('action.layouts.default')
@section('content')
<div class="col-lg-12">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                             <a class="btn btn-primary" href="{{URL::to('emoluments/create_upload')}}" >Upload From Excel</a>
                                 <b class="pull-right"><a class="btn btn-primary" href="{{URL::to('emoluments/create')}}" >Add</a></b>

                            </div>
                            <div class="panel-body">
                <table class="table dt table-hover table-striped table-bordered table-responsive">
                    <thead>
                        <tr>
                         <th>Code No</th>
                         <th> Designation</th>
                         <th> Salary Scale</th>
                         <th>Action</th>
                     </tr>
                     </thead>
                     <tbody>
                     @foreach($refemoluments as $item)
                     <tr>
                         <td>{{$item->code_no}}</td>
                         <td>{{$item->designation}}</td>
                         <td>{{$item->salary_scale}}</td>
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