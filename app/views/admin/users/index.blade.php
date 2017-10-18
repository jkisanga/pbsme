@extends('action.layouts.default')

{{-- Web site Title --}}
@section('title')
	{{{ $title }}} :: @parent
@stop

{{-- Content --}}
@section('content')<div class="x_panel">
	<div class="page-header">
		<h3>
			{{{ $title }}}

			<div class="pull-right">
				<a href="{{{ URL::to('admin/users/create') }}}" class="btn btn-small btn-info iframe" title="Add New PBS User"><span class="glyphicon glyphicon-plus-sign"></span> New User</a>
				<a href="{{{ URL::to('admin/system/positions') }}}" class="btn btn-small btn-default" title="Manage Job Titles"><span class="glyphicon glyphicon-cog"></span> Job Titles</a>
			</div>
		</h3>
	</div>

	<table id="users" class=" dt table table-striped table-hover ">
		<thead>
			<tr>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Title</th>
				<th>Email</th>
				<th>Unit</th>
				<th>status</th>
				<th class="col-md-2">{{{ Lang::get('table.actions') }}}</th>
			</tr>
		</thead>
		<tbody>
        @foreach($users as $user)
        <tr>
            <td>{{$user->first_name}}</td>
            <td>{{$user->last_name}}</td>
            <td>{{$user->title}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->unit->name}}</td>
			 <td>@if($user->active) <span class="alert-success">Active</span> @else <span class="alert-danger">Deactive</span>@endif</td>
		   
            <td class="col-lg-2">
				  <div class="dropdown">
					<button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
					  Options
					  <span class="caret"></span>
					</button>
					<ul class="dropdown-menu " aria-labelledby="dropdownMenu1">
					   <li><a href="{{ URL::to('admin/users/' . $user->id . '/edit')}}" >Edit</a></li>
						 <li> <a href="{{{ URL::to('admin/users/reset_password/' . $user->id  ) }}}">Reset Password</a></li>
					   @if($user->active==true)
					   <li><a href="{{ URL::to('admin/users/' . $user->id . '/deactivate')}}" onclick="return confirm('Are you sure?')">Deactivate</a></li>
					   @else
					   <li><a href="{{ URL::to('admin/users/' . $user->id . '/activate')}}" onclick="return confirm('Are you sure?')">Activate</a></li>
					@endif
			   </ul>
			  </div>
		</td>

        </tr>
       @endforeach
		</tbody>
	</table>
	</div>
@stop

{{-- Scripts --}}
@section('scripts')
	<script type="text/javascript">
		$(document).ready(function() {
			 $('.table').dataTable( );

		});
	</script>
@stop