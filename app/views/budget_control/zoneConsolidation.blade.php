@extends('action.layouts.default')

@section('title')
Budget Consolidation
@parent
@stop

{{-- Content --}}
@section('content')

 <div class="col-md-12">
   <fieldset><legend> <b>{{$unit->zone->zone_name}} Budget Consolidation Panel <span class="pull-right">Financial Year {{$financialYear->year}}</span></b> </legend>

              <div class="row">
                 <div class="col-md-4">Total Number of Units <span class="badge badge-success">{{count($zoneUnits)}}</span> </div>
                 <div class="col-md-8">
                    @foreach($zoneUnits as $unit)
                        {{Str::upper($unit->name)}} |
                    @endforeach
                 </div>
              </div><hr>
               <div class="row">
                 <div class="col-md-4">Units Submitted Budget <span class="badge badge-success">{{count($unitsSubmittedBudget)}}</span> </div>
                 <div class="col-md-8">
                    @foreach($unitsSubmittedBudget as $unit)
                        {{Str::upper($unit->name)}} |
                    @endforeach
                 </div>
              </div><hr>

               <div class="row">
                 <div class="col-md-4">Units Not Submitted Budget <span class="badge badge-success">{{count($zoneUnits) - count($unitsSubmittedBudget)}}</span> </div>

              </div>
                <hr>
              @if(isset($objectives))
                   <form  method="POST" action="{{URL::to('budget/consolidate')}}">

                    <input type="hidden" name="_token" value="{{{ Session::getToken() }}}"/>

              <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12">
                <label>Objective</label>
                    <div class="form-group {{{ $errors->has('objective_id') ? 'has-error' : '' }}}">

                    <select name="objective_id" class="form-control select2" id="objective">
                       <option  value="">Select Objective</option>
                              @foreach($objectives as $objective)
                                 <option value="{{$objective->id}}">{{$objective->ob_code}}:{{$objective->ob_description}}</option>
                               @endforeach
                           </select>
                         {{ $errors->first('objective_id', '<span class="help-block">:message</span>') }}
                    </div>
                 </div>
                 </div>

                    <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                                <label>Targets</label>
                                    <div class="form-group {{{ $errors->has('target_id') ? 'has-error' : '' }}}">
                                        <ul class="list-group"  name="target_id" id="target">

                                       </ul>
                                         {{ $errors->first('target_id', '<span class="help-block">:message</span>') }}
                                    </div>
                                </div>
                  </div>

              @endif

           </form>
      </fieldset>

 </div>

 @stop