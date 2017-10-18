@extends('action.layouts.default')

@section('content')
<div class="row">
              <div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title" style="background-color: #faf2cc">
    <p><a  title="Click to go Back" href="{{URL::to('list_target')}}"><b> Objective {{$obj->ob_code}} : {{$obj->ob_description}}</b></a>
                  <a href="{{URL::to('list_target')}}" class="btn btn-sm btn-default pull-right" title="Back"><i class="fa fa-home"></i></a>
</p>
        <p><a  title="Click to go Back" href="{{URL::to('list_target')}}">Target 0{{$target->target_no}} : {{$target->ta_description}}</a></p>
        <div class="clearfix"></div>
        </div>
                  <div class="x_content">
                    <br />
                <form action="{{URL::to('store_activity')}}" method="post">
                 <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                 <input type="hidden" value="{{$target->id}}" name="target_id" />

                 <div class="row">
                  <div class="col-md-4">
                         <div class="form-group">
                          <label class="control-label">
                                 <b>Financial Year</b> </label>
                             <div class="input-icon right">
                                 <input type="hidden" name="year_id" class="form-control" value="{{$financial_year->id}}" readonly />
                                 <input type="text"  class="form-control" value="{{$financial_year->year}}" readonly />
                                 </div>
                         </div>
                         {{ $errors->first('activity_no', '<span class="help-inline" style="color:red">:message</span>') }}
                     </div>
                <div class="col-md-4">
                    <div class="form-group">
                     <label for="inputName" class="control-label">
                            <b>Activity Code</b> </label>
                        <div class="input-icon right">
                            <input type="text" name="activity_no" class="form-control" value="{{$activity_no}}" readonly />
                            </div>
                    </div>
                    {{ $errors->first('activity_no', '<span class="help-inline" style="color:red">:message</span>') }}
                </div>


                <div class="col-md-4">
                    <div class="form-group">
                     <label for="inputName" class="control-label">
                                             <b>Budget Type</b> </label>
                        <div class="input-icon right">
                            <select name="type" class="form-control">
                            <option value=""  disabled selected >Select Type</option>
                            <option value="Dev">Dev</option>
                            <option value="OC">OC</option>
                            </select>
                            </div>
                    </div>
                    {{ $errors->first('type', '<span class="help-inline" style="color:red">:message</span>') }}
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                    <label for="inputName" class="control-label">Activity Description</label>
                    <textarea   name="a_description" class="form-control focused">{{Input::old('a_description')}}</textarea>
                      {{ $errors->first('a_description', '<span class="help-inline" style="color:red">:message</span>') }}
                     </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group pull-right">
                                  <button  type="submit"  class="btn btn-primary"  ><i class="fa fa-save"></i> Save</button> </div>
                        </div>
                </div>
        </form>
<div class="clearfix"></div>
    <table class=" dt table table-hover table-striped table-bordered table-responsive ">
        <thead>
        <tr>
            <th> Code</th>
            <th>Type</th>
            <th>Description</th>
            <th class="col-lg-1">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($activities as $activity)
        <tr>
            <td>{{$activity->activity_no}}</td>
            <td>{{$activity->type}}</td>
            <td>{{$activity->a_description}}</td>

             <td class="col-lg-1">
                 <div class="dropdown">
                   <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                     Options
                     <span class="caret"></span>
                   </button>
                   <ul class="dropdown-menu " aria-labelledby="dropdownMenu1">
                     <li><a href="{{URL::to('add_item/'.$activity->id)}}" >Add Item</a></li>
                     <li><a href="{{URL::to('editActivity/'.$activity->id)}}" >Edit This Activity</a></li>
                     <li><a href="{{URL::to('delete_activity/'.$activity->id)}}" onclick="return confirm('are you sure?')" >Delete</a></li>
          {{--<li><a href="{{{ URL::to('delete_item/'.$activity->id)}}}" onclick="return confirm('Are you sure?')" >Delete</a></li>--}}

              </ul>
             </div></td>
            </tr>
            @endforeach
            </tbody>
            </table>


                                        </div>
                                    </div>
                                </div>
 </div>
               @stop