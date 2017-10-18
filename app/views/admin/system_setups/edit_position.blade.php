@extends('action.layouts.default')

{{-- Web site Title --}}
@section('title')
GFS Codes
@parent
@stop

{{-- Content --}}
@section('content')

 <div class="col-md-12">
<div class="x_panel">
                  <div class="x_title">
                    <h2>Job Titles <small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form class="form-horizontal form-label-left input_mask" method="POST" action="{{URL::to('admin/system/updatePosition/'.$data->id)}}">
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                      <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="text" name="title" class="form-control "  placeholder="Title" value="{{$data->title}}">
                      {{ $errors->first('title', '<span class="help-inline" style="color:red">:message</span>') }}
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="text" name="description" class="form-control"  placeholder="Title Description" value="{{$data->description}}">
                         {{ $errors->first('description', '<span class="help-inline" style="color:red">:message</span>') }}
                      </div>
                       <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                    <input type="submit" class="btn btn-success" value="Save" />
                        </div>
                    </form>
                  </div>

</div>
</div>
@stop
