@extends('action.layouts.default')

@section('title')
Budget Summary
@parent
@stop

{{-- Content --}}
@section('content')
	@include('reports/includes/reports-header-button')
 <div class="col-md-12">
 <i>Summary of Budget Estimates per zone/station and Objective</i>
   <fieldset><legend>  </legend>

         <form  method="POST" action="{{URL::to('reports/zonesBudgetSummary')}}">
          <input type="hidden" name="_token" value="{{{ Session::getToken() }}}"/>

             <div class="row">
                 <div class="col-xs-4 col-sm-4 col-md-4">

                         <div class="form-group {{ $errors->has('year') ? 'has-error' : '' }}">

                           <select name="year" class="form-control">
                           <option value=""> Select Financial Year</option>
                            @foreach($years as $year )
                            <option value="{{$year->id}}">{{$year->year}}</option>
                            @endforeach
                           </select>
                           {{ $errors->first('year', '<span class="help-block">:message</span>') }}
                         </div>
                      </div>

                         <div class="col-xs-1 col-sm-1 col-md-1">
                           <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Search"/>
                            </div>
                         </div>
						      <div class="col-xs-2 col-sm-2 col-md-2">
							   @if(isset($budgets))
								    <div class="btn-group">
										<button type="button" class="btn btn-primary  dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
										   Download <span class="caret"></span>
										</button>

										<ul class="dropdown-menu" role="menu">
											<li><a href="{{URL::to('reports/budgetSummary')}}"><i class="fa fa-file-excel-o"></i> Excel</a></li>
										   <!--<li><a href="#"><i class="fa fa-file-pdf-o"></i> PDF</a></li> -->

										</ul>
									</div><!--btn group-->
								@endif
                         </div>
             </div>
             </form>
			  {{$reports_view}}
   
  </fieldset>
    </div>
 @stop