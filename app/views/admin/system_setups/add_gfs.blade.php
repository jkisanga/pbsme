@extends('action.layouts.default')

{{-- Web site Title --}}
@section('title')
GFS Codes
@parent
@stop

{{-- Content --}}
@section('content')

 <div class="col-md-12">
   <fieldset><legend> <b> Gfs Codes</b> <a class="btn btn-default pull-right" href="{{URL::to('admin/system/upload_gfs')}}"><i class="glyphicon glyphicon-upload"></i> Upload</a> </legend>

    <form role="login" method="POST" action="@if(isset($gfsCode)){{{ URL::to('admin/system/',$gfsCode->id) }}}@endif">
     <input type="hidden" name="_token" value="{{{ Session::getToken() }}}"/>

        <div class="row">

                <div class="col-xs-12 col-sm-6 col-md-6">
                <label>Item Code</label>
                        <div class="form-group {{{ $errors->has('code') ? 'has-error' : '' }}}">
                            <input type="text" name="code"  class="form-control" value="{{{ Input::old('code', isset($gfsCode) ? $gfsCode->code : null) }}}">
                             {{ $errors->first('code', '<span class="help-block">:message</span>') }}
                        </div>
                </div>

                <div class="col-xs-12 col-sm-6 col-md-6">
                <label>Description</label>
                        <div class="form-group {{{ $errors->has('item_description') ? 'has-error' : '' }}}">
                            <input type="text" name="item_description"  class="form-control" value="{{{ Input::old('item_description', isset($gfsCode) ? $gfsCode->item_description : null) }}}">
                             {{ $errors->first('item_description', '<span class="help-block">:message</span>') }}
                        </div>
                </div>

        </div>

        <div class="row">
            <div class="col-md-2">
            <input type="submit" value="Add/update" class="btn btn-primary btn-block">
            </div>

        </div>
    </form>
    </fieldset>

    <br>
    <table class=" dt table table-striped table-hover table-bordered table-responsive">
    		<thead>
    			<tr>
    				<th class="col-md-2">Code</th>
    				<th class="col-md-8">Description</th>

    				<th class="col-md-2">Action</th>
    			</tr>
    		</thead>

    		<tbody>
    		    @foreach($gfsCodes as $gfsCode)
    		    <tr>
    		    <td>{{$gfsCode->code}}</td>
    		    <td>{{$gfsCode->item_description}}</td>
    		    <td>


    		        <a class ="btn btn-small btn-danger" href="{{URL::to('admin/system/delete_gfs/',$gfsCode->id)}}" onclick="return confirm('You want to delete?')"><i class="glyphicon glyphicon-remove-sign"></i></a>

    		    </td>
    		    </tr>
    		    @endforeach

    		</tbody>
    	</table>
</div>

@stop
