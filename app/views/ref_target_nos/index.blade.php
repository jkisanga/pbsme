@extends('action.layouts.default')


@section('content')
<div class="col-lg-12">
                        <div class="panel panel-green">
                            <div class="panel-heading">Target No
                                 <b class="pull-right"><a class="btn btn-primary" href="{{URL::to('refTargetNo/create')}}" >Add Target No</a></b>

                            </div>
                            <div class="panel-body">
                                <table class="table dt table-hover table-striped">
                                    <thead>
                                    <tr>
                         <th>No</th>
                         <th>Target No</th>
                         <th>Action</th>
                     </tr>
                     </thead>
                     <tbody>
                     @foreach($reftargetnos as $item)
                     <tr>
                         <td>{{$item->no}}</td>
                         <td>{{$item->name}}</td>
                         <td class="col-lg-2">
                         <div class="dropdown">
                           <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                             Options
                             <span class="caret"></span>
                           </button>
                           <ul class="dropdown-menu " aria-labelledby="dropdownMenu1">
                             <li><a href="{{URL::to('refTargetNo/edit/'.$item->id)}}" >Edit</a></li>
		          <li><a href="{{{ URL::to('refTargetNo/delete/'.$item->id)}}}" onclick="return confirm('Are you sure?')" >Delete</a></li>

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