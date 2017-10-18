@extends('action.layouts.default')

@section('title')
Budget Consolidation
@parent
@stop

{{-- Content --}}
@section('content')

<div class="row">
 <div class="col-md-12">
 <form id="zonal-activity"  method="POST" action="{{URL::to('budget/activityConsolidation')}}">

    <input type="hidden" name="_token" value="{{{ Session::getToken() }}}"/>
    <input type="hidden" name="zone_id" value="{{$unit->zone->id}}"/>
    <input type="hidden" name="target_id" value="{{$target->id}}"/>
    <input type="hidden" name="year_id" value="{{$financialYear->id}}"/>
  <fieldset><legend> <b class="text-info">{{$unit->zone->zone_name}} Budget Consolidation Panel <span class="pull-right">Financial Year {{$financialYear->year}}</span></b> </legend>
     <div class="row">
        <div class="col-xs-2 col-sm-2 col-md-2">
                    <b>OBJECTIVE:</b>
              </div>

        <div class="col-xs-10 col-sm-10 col-md-10 form-group">
                  <input readonly="true" class="form-control" value="{{$target->objective->ob_code}}: {{$target->objective->ob_description}}">

              </div>
        </div>

          <div class="row">
        <div class="col-xs-2 col-sm-2 col-md-2">
                    <b>TARGET:</b>
              </div>
            <div class="col-xs-10 col-sm-10 col-md-10 form-group">
                  <input type="hidden" value="{{$target->id}}" name="target_id">
                   <input readonly="true" class="form-control" value="{{$target->target_no}}: {{$target->ta_description}}">
              </div>
        </div>
</fieldset>

        <fieldset>
                <legend class="text-info">List of activities from units to be consolidated

                 </legend>
                <div class="panel-body">
                  <div class="row">

                  <div class="col-xs-12 col-sm-12 col-md-12">
                      <label>Select Activities </label> <label class="pull-right label-warning">Pending <span class="badge"> {{count($activities)}}</span></label>
                                           <div class="form-group {{{ $errors->has('activities') ? 'has-error' : '' }}}">
                                             <select class="form-control select2" multiple="multiple" name="activities[]">
											 @if(Input::old('activities') > 0)												 
											 <?php 
											 foreach(Input::old('activities') as $activity_id){
												 $activity = Activity::find($activity_id);
												?>
												  <option selected="true" value="{{$activity->id}}">{{$activity->unit->name}} [{{$activity->activity_no}}-{{$activity->a_description}}]</option>
												<?php
											 }
												
											 ?>
											 @endif
                                                @foreach($activities as $activity)
                                                 <option value="{{$activity->id}}">{{$activity->name}} [{{$activity->activity_no}}-{{$activity->a_description}}]</option>
                                               @endforeach
											   
											
                                              {{ $errors->first('activities', '<span class="help-block">:message</span>') }}
                                             </select>
                                           </div>
                                   </div>
                            </div>

                   <div class="row">

                   <div class="col-xs-3 col-sm-3 col-md-3">
                         <label>New Activity Number</label>
                                      <div class="form-group {{{ $errors->has('number') ? 'has-error' : '' }}}">
                                       <input name="number" type="text" class="form-control" value="{{Input::old('number')}}"/>
                                           {{ $errors->first('number', '<span class="help-block">:message</span>') }}
                                      </div>
                              </div>
                                 <div class="col-xs-3 col-sm-3 col-md-3">
                                   <label>Budget Type</label>
                                  <div class="form-group {{{ $errors->has('type') ? 'has-error' : '' }}}">
                                          <select name="type" class="form-control">
                                         
										  @if(Input::old('type'))
											   <option value="{{Input::old('type')}}" >{{Input::old('type')}}</option>
											@else
												 <option value=""  disabled >Select Type</option>
											@endif
                                          <option value="Dev">Dev</option>
                                          <option value="OC">OC</option>
                                          </select>
                                              {{ $errors->first('type', '<span class="help-block">:message</span>') }}
                                  </div>

                              </div>
                          <div class="col-xs-6 col-sm-6 col-md-6">
                                   <label>New Activity Description</label>
                                           <div class="form-group {{{ $errors->has('description') ? 'has-error' : '' }}}">
                                            <textarea name="description" class="form-control">{{Input::old('description')}}</textarea>
                                                {{ $errors->first('description', '<span class="help-block">:message</span>') }}
                                           </div>
                                   </div>
                            </div>

                      <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                              <a href="{{URL::to('budget/consolidate')}}" class="btn btn-primary btn-small"><i class="fa fa-backward"></i> Back</a>
                             <span class="pull-right">
                                <button type="submit" class="btn btn-primary btn-small"> <i class="fa fa-save"></i> Add New</button>
                                </span>
                            </div>
                      </div>
                </div>
        </fieldset>
        </form>

        @if(isset($zonalActivities))
                <table class="table dt table-bordered table-stripped dtable">
                <thead>
                    <th>Activity Number</th>
                    <th>Description</th>
                    <th class="col-md-1">Action</th>
                 </thead>
                 <tbody>
                    @foreach($zonalActivities as $activity)
                        <tr>
                            <td>{{$activity->number}}</td>
                            <td>{{$activity->description}}</td>
                            <td><a class="btn btn-primary" href="{{URL::to('budget/zone/delete',$activity->id)}}" onclick="return confirm('Are you sure?');"> <i class="fa fa-share"></i> Undo</a></td>
                        </tr>
                    @endforeach
                 </tbody>
                </table>

        @endif

</div>
</div>
@stop