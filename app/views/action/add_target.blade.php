@extends('action.layouts.default')

@section('content')
                <!--BEGIN CONTENT-->
<div class="page-content">
<div id="tab-general">
<div class="row mbl">
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-grey">
            <div class="panel-heading">
          {{$objective->ob_code}} : {{$objective->ob_description}}</div>
            <div class="panel-body pan">
                <form action="{{URL::to('store_target')}}" method="post">
                <div class="form-body pal">
                 <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                 <input type="hidden" value="{{$objective->id}}" name="objective_id" />
<div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                     <label for="inputName" class="control-label">
                                             <b>Target No</b> </label>
                        <div class="input-icon right">
                            <select name="target_no" class="form-control">
                            <option value=""  disabled selected >Select No</option>
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
                            <option value=""  disabled selected >Select Type</option>
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
        <textarea rows="1" placeholder="Add Target Description" name="ta_description" class="form-control"></textarea></div>
                    </div>
                    {{ $errors->first('ta_description', '<span class="help-inline" style="color:red">:message</span>') }}
                </div>
            </div>
            <div class="col-md-6">
              <div class="form-group pull-right">
                      <input  type="submit"  class="btn btn-primary" value="Add Target" /></div>
            </div>
                                                </div>
                                                </div>
                                                </form>
                                                <hr />
<div class="panel-body">
    <table class=" dt table table-hover table-striped table-bordered table-responsive ">
        <thead>
        <tr>
            <th>No</th>
            <th>Type</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($targets as $target)
        <tr>
            <td>{{$target->target_no}}</td>
            <td>{{$target->target_type}}</td>
            <td>{{$target->ta_description}}</td>
             <td class="col-lg-2">
                      <div class="dropdown">
                        <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                          Options
                          <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu " aria-labelledby="dropdownMenu1">
                          <li><a href="{{URL::to('edit_target',$target->id)}}" >Edit</a></li>

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
                            </div>
                        </div>
                    </div>
                    </div>
                <!--END CONTENT-->
               @stop