@extends('action.layouts.default')

@section('content')
 <!--BEGIN CONTENT-->
  <div class="col-md-12 col-xs-12">
                 <div class="x_panel">
                   <div class="x_title">
                   <form  method="POST" action="{{URL::to('submissions/postZoneReport')}}">
                 <input type="hidden" name="_token" value="{{{ Session::getToken() }}}"/>

                    <div class="row">
                        <div class="col-xs-4 col-sm-4 col-md-4">

                                <div class="form-group {{ $errors->has('year') ? 'has-error' : ''}}">

                                  <select name="year" class="form-control">
                                  <option value=""> Select Financial Year</option>
                                   @foreach($years as $year )
                                   <option value="{{$year->id}}">{{$year->year}}</option>
                                   @endforeach
                                  </select>
								{{ $errors->first('year', '<span class="help-block">:message</span>') }}
                                </div>
                             </div>
							 	@if(Auth::user()->hasRole('supermanager'))	
											   <div class="col-xs-2 col-sm-2 col-md-2">

                                                   <div class="form-group  {{{ $errors->has('zone') ? 'has-error' : '' }}}">
                                                     <select name="zone" class="form-control">
                                                     <option value="{{$zone->id}}"> {{$zone->zone_name}}</option>
                                                      @foreach($zones as $zone )
                                                      <option value="{{$zone->id}}">{{$zone->zone_name}}</option>
                                                      @endforeach
                                                     </select>
                                                      {{ $errors->first('zone', '<span class="help-block">:message</span>') }}
                                                   </div>
                                                </div>
												@endif
                                <div class="col-xs-2 col-sm-2 col-md-2">
                                  <div class="form-group">
                                   <input type="submit" class="btn btn-primary" value="Search"/>
                                   </div>
                                </div>
								@if(isset($print))
									<div class="col-xs-2 col-sm-2 col-md-2">
									   <div class="btn-group">
											<button type="button" class="btn btn-primary  dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
											   Download <span class="caret"></span>
											</button>

											<ul class="dropdown-menu" role="menu">
												<li><a href="{{URL::to('submissions/downloadZoneReport')}}"><i class="fa fa-file-excel-o"></i> Excel</a></li>
										
											</ul>
										</div><!--btn group-->                                </div>
								@endif
								
                    </div>
                    </form>
                   </div>
				<div class="x_content">
				   {{$revenue_view}}
						  
				</div>
				</div>
               </div>



                    @stop
