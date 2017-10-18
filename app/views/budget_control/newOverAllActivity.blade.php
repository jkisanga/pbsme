@extends('action.layouts.default')

@section('title')
Budget Consolidation
@parent
@stop

{{-- Content --}}
@section('content')

<div class="row">
 <div class="col-md-12">
 <form id="overall-activity"  method="POST" action="{{URL::to('budget/overAll')}}">

    <input type="hidden" name="_token" value="{{{ Session::getToken() }}}"/>
    <input type="hidden" name="target_id" value="{{$target->id}}"/>
    <input type="hidden" name="year_id" value="{{$financialYear->id}}"/>
  <fieldset><legend> <b class="text-info">TFS Overall Budget Consolidation Panel<span class="pull-right">Financial Year {{$financialYear->year}}</span></b> </legend>
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
                <legend class="text-info">List of activities from Zones to be consolidated

                 </legend>
                <div class="panel-body">
                  <div class="row">

                   <div class="col-xs-12 col-sm-12 col-md-12">
                      <label>Select Activities</label><label class="pull-right label-warning">Pending <span class="badge"> {{count($activities)}}</span></label>
                                           <div class="form-group {{{ $errors->has('activity_id') ? 'has-error' : '' }}}">
                                             <select class="form-control select2" multiple="multiple" name="activities[]">
                                                @foreach($activities as $activity)
                                                 <option value="{{$activity->id}}">{{$activity->zone->zone_name}} [{{$activity->number}}-{{$activity->description}}]</option>
                                               @endforeach
                                              {{ $errors->first('activity_id', '<span class="help-block">:message</span>') }}
                                             </select>
                                           </div>
                                   </div>
                            </div>

                   <div class="row">

                   <div class="col-xs-3 col-sm-3 col-md-3">
                         <label>New Activity Number</label>
                                      <div class="form-group {{{ $errors->has('number') ? 'has-error' : '' }}}">
                                       <input name="number" type="text" class="form-control"/>
                                           {{ $errors->first('number', '<span class="help-block">:message</span>') }}
                                      </div>
                              </div>
                                 <div class="col-xs-3 col-sm-3 col-md-3">
                                   <label>Budget Type</label>
                                  <div class="form-group {{{ $errors->has('type') ? 'has-error' : '' }}}">
                                          <select name="type" class="form-control">
                                          <option value=""  disabled selected >Select Type</option>
                                          <option value="Dev">Dev</option>
                                          <option value="OC">OC</option>
                                          </select>
                                              {{ $errors->first('type', '<span class="help-block">:message</span>') }}
                                  </div>

                              </div>
                          <div class="col-xs-6 col-sm-6 col-md-6">
                                   <label>New Activity Description</label>
                                           <div class="form-group {{{ $errors->has('description') ? 'has-error' : '' }}}">
                                            <textarea name="description" class="form-control"></textarea>
                                                {{ $errors->first('description', '<span class="help-block">:message</span>') }}
                                           </div>
                                   </div>
                            </div>

                      <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                              <a href="{{URL::to('budget/overAllConsolidate')}}" class="btn btn-primary btn-small">Back</a>
                             <span class="pull-right">
                                <input type="submit" class="btn btn-primary btn-small" value="Add New">
                                </span>
                            </div>
                      </div>
                </div>
        </fieldset>
        </form>

        @if(isset($overAllActivities))
                <table class="table dt table-bordered table-stripped dtable">
                <thead>
                    <th>Activity Number</th>
                    <th>Description</th>
                    <th>Action</th>
                 </thead>
                 <tbody>
                    @foreach($overAllActivities as $activity)
                        <tr>
                            <td>{{$activity->number}}</td>
                            <td>{{$activity->description}}</td>
                              <td><a class="btn btn-primary" href="{{URL::to('budget/overall/activity/delete',$activity->id)}}" onclick="return confirm('Are you sure?');"> <i class="fa fa-share"></i> Undo</a></td>
                        </tr>
                    @endforeach
                 </tbody>
                </table>

        @endif

</div>
</div>
@stop