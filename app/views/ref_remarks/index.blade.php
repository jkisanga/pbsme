@extends('action.layouts.default')


@section('content')
<div class="col-lg-12">
                        <div class="panel panel-green">
                            <div class="panel-heading">Remarks References
                                 <b class="pull-right"><a class="btn btn-primary" href="{{URL::to('pe_remarks/create')}}" >Add Remark Reference</a></b>
                            </div>
                            <div class="panel-body">
                                <table class="table dt table-hover table-striped">
                                    <thead>
                                    <tr>
                         <th>Name</th>
                         <th class="col-lg-2">Action</th>
                     </tr>
                     </thead>
                     <tbody>
                     @foreach($items as $item)
                     <tr>
                         <td>{{$item->name}}</td>
                         <td class="col-lg-2">
                         <div class="dropdown">
                           <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                             Options
                             <span class="caret"></span>
                           </button>
                           <ul class="dropdown-menu " aria-labelledby="dropdownMenu1">
                             <li><a href="{{URL::to('re_remarks/edit/'.$item->id)}}" >Edit</a></li>
		          <li><a href="{{{ URL::to('re_remarks/delete/'.$item->id)}}}" onclick="return confirm('Are you sure?')" >Delete</a></li>

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