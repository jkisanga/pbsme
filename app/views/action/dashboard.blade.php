@extends('action.layouts.default')

@section('content')
 <!--BEGIN CONTENT-->

                <div class="panel panel-default">
                    <div class="panel-heading"><h5>Zones with associated number of units/districts</h5></div>
                        <div class="panel-body">
                        <div class="row">

                             <div class="col-sm-12 col-md-12">
                              <ul class="nav nav-tabs">
							  @foreach($zones as $zone)
								  <li><a href="#">{{$zone->zone_name}} <span class="badge bg-green"> {{count($zone->units)}}</span></a></li>
								  
							@endforeach
								</ul>
							</div>
							</div>
                        </div>
                </div>

           

			   @if(Auth::user()->hasRole('manager'))
                 <div class="page-content">
                    <div id="tab-general">
                     <div class="row">                      
                         <div class="col-sm-12 col-md-12">
                           {{$budgets_view}}
                        </div>

                    </div>
                </div>
                </div>

               @endif
                <!--END CONTENT-->
               @stop