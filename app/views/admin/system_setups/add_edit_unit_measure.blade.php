@extends('action.layouts.default')

{{-- Web site Title --}}
@section('title')
Farm Categories
@parent
@stop

{{-- Content --}}
@section('content')

 <div class="col-md-12">
   <fieldset><legend> <b> Unit Measures</b></legend>

    <form role="login" method="POST" action="@if(isset($unit_measure)){{{ URL::to('admin/system/edit_unit_measure',$unit_measure->id) }}}@endif">
     <input type="hidden" name="_token" value="{{{ Session::getToken() }}}"/>

        <div class="row">

                <div class="col-xs-12 col-sm-6 col-md-6">
                <label>Description</label>
                        <div class="form-group {{{ $errors->has('description') ? 'has-error' : '' }}}">
                            <input type="text" name="description"  class="form-control" value="{{{ Input::old('description', isset($unit_measure) ? $unit_measure->description : null) }}}">
                             {{ $errors->first('description', '<span class="help-block">:message</span>') }}
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
    				<th class="col-md-10">Description</th>

    				<th class="col-md-2">Action</th>
    			</tr>
    		</thead>

    		<tbody>
    		    @foreach($unit_measures as $unit_measure)
    		    <tr>
    		    <td>{{$unit_measure->description}}</td>
    		    <td>


    		        <a class ="btn btn-small btn-danger" href="{{URL::to('admin/system/delete_unit_measure',$unit_measure->id)}}" onclick="return confirm('You want to delete?')"><i class="glyphicon glyphicon-remove-sign"></i></a>

    		    </td>
    		    </tr>
    		    @endforeach

    		</tbody>
    	</table>
</div>

@stop
