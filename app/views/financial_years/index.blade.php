@extends('action.layouts.default')


@section('content')
<div class="col-lg-12">
                        <div class="panel panel-green">
                            <div class="panel-heading"> <small style="color: red"> NOTE: Only one Financial Year Should be Active</small>
                                 <b class="pull-right"><a class="btn btn-primary" href="{{URL::to('financial_year/create')}}" >Add Financial Year</a></b>

                            </div>
                            <div class="panel-body">
				<table class="table dt  table-hover table-striped table-bordered table-responsive ">
					<thead>
                        <tr>
							 <th>Year</th>
							  <th>Projection Percentage</th>
							 <th>Status</th>						
							 <th class="col-lg-2">Action</th>
                     </tr>
                     </thead>
                     <tbody>
                     @foreach($items as $item)
                     <tr>
                         <td>{{$item->year}}</td>
                         <td>{{$item->projection_percentage}}</td>
                         <td>@if($item->status == 0) <b style="color: #802420">Inactive</b>@else<b style="color: #009926"> Active</b> @endif</td>
                         <td class="col-lg-2">
								 @if($item->status == 0)
								 <div class="dropdown">
								   <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
									 Options
									 <span class="caret"></span>
								   </button>
								   <ul class="dropdown-menu " aria-labelledby="dropdownMenu1">
									 <li><a href="{{URL::to('financial_year/edit/'.$item->id)}}" >Edit</a></li>
									 <li><a href="{{URL::to('financial_year/activate/'.$item->id)}}" onclick="return confirm('Are sure  ?')"  >Activate</a></li>

							  </ul>
							 </div>@else
							 <b>No Options</b>
							 @endif
						</td>
					 </tr>
                     @endforeach
                    </tbody>
                                    </table>
				</div>
				</div>
				</div>

                    @stop