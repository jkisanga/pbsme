@extends('action.layouts.default')

@section('content')

<div class="panel-body pan">
                <form action="{{URL::to('updateActivity/'.$activity->id)}}" method="post">
                <div class="form-body pal">
                 <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                 <input type="hidden" name="target_id" value="{{{ $activity->target_id }}}" />

<div class="row">

                <div class="col-md-3">
                    <div class="form-group">
                     <label for="inputName" class="control-label">
                            <b>Activity Code</b> </label>
                        <div class="input-icon right">
                            <input type="text" readonly="true" name="activity_no" class="form-control" value="{{$activity->activity_no}}"  />
                            </div>
                    </div>
                    {{ $errors->first('activity_no', '<span class="help-inline" style="color:red">:message</span>') }}
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                     <label for="inputName" class="control-label">
                                             <b>Budget Type</b> </label>
                        <div class="input-icon right">
                            <select name="type" class="form-control">
                            <option value="{{$activity->type}}" selected="selected" >{{$activity->type}}</option>
                            <option value="Dev">Dev</option>
                            <option value="OC">OC</option>
                            </select>
                            </div>
                    </div>
                    {{ $errors->first('type', '<span class="help-inline" style="color:red">:message</span>') }}
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                    <label for="inputName" class="control-label">
                         <b> Activity Description</b> </label>
 <div class="form-group mbn">
        <textarea   name="a_description"  class="form-control">{{$activity->a_description}}</textarea></div>
                    {{ $errors->first('a_description', '<span class="help-inline" style="color:red">:message</span>') }}
                </div>
            </div>
            <div class="col-md-6">
              <div class="form-group pull-left">
                      <input  type="submit"  class="btn btn-primary" value="Update" /></div>
            </div>
    </div>
        </div>
        </form>
        </div>
        @stop