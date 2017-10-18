@extends('action.layouts.default')

@section('content')
                <!--BEGIN CONTENT-->
<div class="page-content">
<div id="tab-general">
<div class="row mbl">
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-grey">
            <div class="panel-heading"></div>
            <div class="panel-body pan">
                <form action="{{URL::to('update_target',$target->id)}}" method="post">
                <div class="form-body pal">
                 <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                 <input type="hidden" value="{{$target->objective_id}}" name="objective_id" />
<div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                     <label for="inputName" class="control-label">
                                             <b>Target No</b> </label>
                        <div class="input-icon right">
                            <select name="target_no" class="form-control">
                            <option value="{{$target->target_no}}" selected >Select </option>
                            @foreach($targetTypes as $targetNo)
                            <option value="{{$targetNo->no}}">{{$targetNo->name}}</option>
                            @endforeach
                            </select>
                            </div>
                    </div>
                    {{ $errors->first('name', '<span class="help-inline" style="color:red">:message</span>') }}
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                     <label for="inputName" class="control-label">
                                             <b>Target Type</b> </label>
                        <div class="input-icon right">
                            <select name="target_type" class="form-control">
                            <option value="{{$target->target_type}}"   selected >{{$target->target_type}}</option>
                            <option value="S">S</option>
                            <option value="C">C</option>
                            <option value="D">D</option>
                            </select>
                            </div>
                    </div>
                    {{ $errors->first('target_type', '<span class="help-inline" style="color:red">:message</span>') }}
                </div>

                <div class="col-md-9">
                    <div class="form-group">
                    <label for="inputName" class="control-label">
                         <b>Target Description</b> </label>
                        <div class="input-icon right">
            <div class="form-group mbn">
         <textarea rows="1" placeholder="Add Target Description" name="ta_description" class="form-control">
         {{$target->ta_description}}
         </textarea></div>
                    </div>
                    {{ $errors->first('ta_description', '<span class="help-inline" style="color:red">:message</span>') }}
                </div>
            </div>
            <div class="col-md-6">
              <div class="form-group pull-right">
                      <input  type="submit"  class="btn btn-primary" value="update Target" /></div>
            </div>
                                                </div>
                                                </div>
                                                </form>
                                                <hr />

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                <!--END CONTENT-->
               @stop