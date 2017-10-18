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
                    <h2>Job Titles <small>Fill the form below to add new job Title OR Edit/Delete Job Titles form the list</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form class="form-horizontal form-label-left input_mask" method="POST" action="{{URL::to('admin/system/storePosition')}}">
                    <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                      <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="text" name="title" class="form-control "  placeholder="Title">
                      {{ $errors->first('title', '<span class="help-inline" style="color:red">:message</span>') }}
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                        <input type="text" name="description" class="form-control"  placeholder="Title Description">
                         {{ $errors->first('description', '<span class="help-inline" style="color:red">:message</span>') }}
                      </div>
                       <div class="col-md-3 col-sm-6 col-xs-12 form-group has-feedback">
                    <input type="submit" class="btn btn-success" value="Save" />
                        </div>
                    </form>
                  </div>

    <br>
    <table class=" dt table table-striped table-hover table-bordered table-responsive">
    		<thead>
    			<tr>
    				<th class="col-md-3">Title</th>
    				<th class="col-md-7">Description</th>
    				<th class="col-md-2">Action</th>
    			</tr>
    		</thead>

    		<tbody>
    		    @foreach($values as $value)
    		    <tr>
    		    <td>{{$value->title}}</td>
    		    <td>{{$value->description}}</td>
    		    <td>
    		        <a title="Edit Job Title" class ="btn btn-small btn-info" href="{{URL::to('admin/system/positions/edit',$value->id)}}"><i class="glyphicon glyphicon-pencil"></i></a>
    		        <a title="Delete" class ="btn btn-small btn-danger" href="{{URL::to('admin/system/deletePosition',$value->id)}}" onclick="return confirm('You want to delete?')"><i class="glyphicon glyphicon-remove"></i></a>
    		    </td>
    		    </tr>
    		    @endforeach

    		</tbody>
    	</table>
</div>
</div>
@stop
