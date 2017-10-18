@extends('action.layouts.default')

@section('content')
                <!--BEGIN CONTENT-->
<div class="page-content">
<div id="tab-general">
<div class="row mbl">
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-green">
            <div class="panel-heading">
                Objective Form</div>
            <div class="panel-body pan">
                <form action=" @if (isset($objective)){{ URL::to('update_objective/' . $objective->id ) }} @else {{URL::to('store_objective')}}@endif" method="post">
                <div class="form-body pal">
                 <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
            <div class="row">

                <div class="col-md-3">
                    <div class="form-group">
                     <label for="inputName" class="control-label">
                           <b>Objective Code</b> </label>
                        <div class="input-icon right">
                            <select name="ob_code" class="form-control">
                            <option  value="{{{Input::old('ob_code', isset($objective) ? $objective->ob_code : null)}}}">{{{Input::old('ob_code', isset($objective) ? "OBJECTIVE". $objective->ob_code : "Select Code")}}}</option>
                                @foreach($codes as $code)
                            <option value="{{$code->code}}">{{$code->name}}</option>
                            @endforeach
                            </select>
                            </div>
                    </div>
                    {{ $errors->first('ob_code', '<span class="help-inline" style="color:red">:message</span>') }}
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                    <label for="inputName" class="control-label">
                         <b>Objective Description</b> </label>
                        <div class="input-icon right">
            <div class="form-group mbn">
                 <textarea rows="3" placeholder="Add Objective Description" name="ob_description" class="form-control">
                 {{{Input::old('ob_description', isset($objective) ? $objective->ob_description : null)}}}
                 </textarea></div>
                    </div>
                    {{ $errors->first('ob_description', '<span class="help-inline" style="color:red">:message</span>') }}
                </div>
            </div>
            <div class="col-md-6">
              <div class="form-group pull-right">
                      <input  type="submit"  class="btn btn-primary" value="Submit" /></div>
            </div>
                                                    <hr />
                                                </div>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <!--END CONTENT-->
               @stop