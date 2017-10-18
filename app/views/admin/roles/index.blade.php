@extends('action.layouts.default')

{{-- Web site Title --}}
@section('title')
	{{{ $title }}} :: @parent
@stop

{{-- Content --}}
@section('content')
	<div class="page-header">
		<h3>
			Role Management

			<div class="pull-right">
				<a href="{{{ URL::to('admin/roles/create') }}}" class="btn btn-small btn-info iframe"><span class="glyphicon glyphicon-plus-sign"></span> Create</a>
			</div>
		</h3>
	</div>

	<table id="roles" class="table dt table-striped table-hove dtabler">
		<thead>
			<tr>
				<th class="col-md-6">{{{ Lang::get('admin/roles/table.name') }}}</th>
				<th class="col-md-2">{{{ Lang::get('admin/roles/table.created_at') }}}</th>
				<th class="col-md-2">{{{ Lang::get('table.actions') }}}</th>
			</tr>
		</thead>
		<tbody>

		@foreach($roles as $role)
		<tr>
		     <td>{{$role->name}}</td>
             <td>{{$role->created_at}}</td>
              <td><a href="#"><i class="glyphicon glyphicon-edit"></i></a></td>
		</tr>
		@endforeach
		</tbody>
	</table>
@stop

