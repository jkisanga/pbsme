@extends('action.layouts.default')

@section('content')
 <!--BEGIN CONTENT-->

                <div class="page-content">
                    <div id="tab-general">
                        <div id="sum_box" class="row mbl">
								@include('reports/includes/reports-header-button')

                             <div class="col-sm-12 col-md-12">
                             <fieldset><legend></legend>
                                 <form  method="POST" action="{{URL::to('reports/unitForm3cView')}}">
                                  <input type="hidden" name="_token" value="{{{ Session::getToken() }}}"/>

                                     <div class="row">
                                         <div class="col-xs-3 col-sm-3 col-md-3">

                                                 <div class="form-group {{ $errors->has('year') ? 'has-error' : '' }}">

                                                   <select name="year" class="form-control">
                                                   <option value=""> Select Financial Year</option>
                                                    @foreach($years as $year )
                                                    <option  value="{{$year->id}}">{{$year->year}}</option>
                                                    @endforeach
                                                   </select>
                                                    {{ $errors->first('year', '<span class="help-block">:message</span>') }}
                                                 </div>
                                              </div>
											  	@if( Auth::user()->hasRole('manager') )
											   <div class="col-xs-2 col-sm-2 col-md-2">

                                                   <div class="form-group  {{{ $errors->has('unit') ? 'has-error' : '' }}}">
                                                     <select name="unit" class="form-control">
                                                     <option value="{{$unit->id}}"> {{$unit->name}}</option>
                                                      @foreach($units as $unit )
                                                      <option value="{{$unit->id}}">{{$unit->name}}</option>
                                                      @endforeach
                                                     </select>
                                                      {{ $errors->first('unit', '<span class="help-block">:message</span>') }}
                                                   </div>
                                                </div>
												@endif
                                        
                                                 <div class="col-xs-4 col-sm-4 col-md-4">

                                                    {{$export_buttons}}

                                                 </div>

                                     </div>
                                     </form>
                                     </fieldset>

                                    {{$reports_view}}

                             </div>
                          </div>
                       </div>
                    </div>

                    @stop
