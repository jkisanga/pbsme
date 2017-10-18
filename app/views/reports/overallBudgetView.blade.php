@extends('action.layouts.default')

@section('content')
 <!--BEGIN CONTENT-->
                <div class="page-content">
                    <div id="tab-general">
                        <div id="sum_box" class="row mbl">
								@include('reports/includes/reports-header-button')
                             <div class="col-sm-12 col-md-12">
                                <i>NOTE: Select Financial Year only to get Full Budget OR Financial Year and Objective to get Budget per Objective</i>
                             <fieldset><legend></legend>
                                 <form  method="POST" action="{{URL::to('reports/overallBudget')}}">
                                  <input type="hidden" name="_token" value="{{{ Session::getToken() }}}"/>

                                     <div class="row">
                                         <div class="col-xs-3 col-sm-3 col-md-3">
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

                                         <div class="col-xs-3 col-sm-3 col-md-3">
                                                 <div class="form-group">
                                                   <select name="objective_id" class="form-control">
                                                   <option value=""> Select Objective</option>
                                                    @foreach(Objective::orderBy('ob_code')->get() as $objective )
                                                    <option value="{{$objective->id}}">OBJECTIVE : {{$objective->ob_code}}</option>
                                                    @endforeach
                                                   </select>

                                                 </div>
                                              </div>
                                                 <div class="col-xs-3 col-sm-3 col-md-3">
                                                  	   {{$export_buttons}}
                                                 </div>
                                     </div>
                                     </form>
                                     </fieldset>
									   {{$reports_view}}
                          
                          </div>
                       </div>
                    </div>

                    @stop
