@extends('action.layouts.default')

{{-- Content --}}

@section('content')


	{{-- Create User Form --}}
	<br>
	<ul>
	    	@foreach($errors->all() as $smg)
	    	<li>{{$smg}}</li>
	    	@endforeach
	</ul>

	<div class="panel panel-default">	
		<div class="panel-heading">{{$title}}</div>
						<div class="panel-body">


	<form class="form-horizontal row" method="post" action="@if (isset($user)){{ URL::to('admin/users/' . $user->id . '/edit') }}@endif" autocomplete="off">
		<!-- CSRF Token -->
		<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
		<!-- ./ csrf token -->

		<!-- Tabs Content -->
		<div class="tab-content col-lg-12 ">
			<!-- General tab -->
			<div class="tab-pane active" id="tab-general">
				<!-- username -->
				<div class="form-group {{{ $errors->has('FirstName') ? 'required' : '' }}}">
					<label class="col-md-2 control-label" for="FirstName">First Name</label>
					<div class="col-md-4">
						<input class="form-control" type="text" name="FirstName" id="FirstName" value="{{{ Input::old('FirstName', isset($user) ? $user->first_name : null) }}}" />
						{{ $errors->first('FirstName', '<span class="text-danger">:message</span>') }}
					</div>

					<label class="col-md-2 control-label" for="LastName">Last Name</label>
                                            <div class="col-md-4">
                                                <input class="form-control" type="text" name="LastName" id="LastName" value="{{{ Input::old('LastName', isset($user) ? $user->last_name : null) }}}" />
                                                {{ $errors->first('LastName', '<span class="text-danger">:message</span>') }}
                                            </div>
				</div>

                     <div class="form-group {{{ $errors->has('title') ? 'required' : '' }}}">
                        <label class="col-md-2 control-label" for="title">Job Title</label>
                        <div class="col-md-4">
                         <select class="form-control select2" name="title">
                        						       <option value="{{{Input::old('title', isset($user) ? $user->title : null)}}}"> {{{Input::old('title', isset($user) ? $user->title : null)}}}</option>
                                                        @foreach (Position::all() as $position)

                                                          <option value="{{{ $position->title }}}"> {{$position->title}}</option>

                                                        @endforeach
                                                </select>



                            {{--<input class="form-control" type="text" name="title" id="title" value="{{{ Input::old('title', isset($user) ? $user->title : null) }}}" />--}}
                            {{ $errors->first('title', '<span class="text-danger">:message</span>') }}
                        </div>
                        <label class="col-md-2 control-label" >Mobile</label>
                        <div class="col-md-4">
                            <input class="form-control" type="text" name="mobile" id="mobile" value="{{{ Input::old('mobile', isset($user) ? $user->mobile : null) }}}" />
                            {{ $errors->first('mobile', '<span class="text-danger">:message</span>') }}
                        </div>


                    </div>

				<div class="form-group {{{ $errors->has('email') ? 'required' : '' }}}">
					<label class="col-md-2 control-label" for="email">Email</label>
					<div class="col-md-4">
						<input class="form-control" type="text" name="email" id="email" value="{{{ Input::old('email', isset($user) ? $user->email : null) }}}" />
						{{ $errors->first('email', '<span class="text-danger">:message</span>') }}
					</div>
			   <label class="col-md-2 control-label" for="roles">Roles</label>
                    	                <div class="col-md-4">
                    		                <select class="form-control select2" name="roles[]" id="roles[]" >
                    		                        @foreach ($roles as $role)
                    									@if ($mode == 'create')
                    		                        		<option value="{{{ $role->id }}}"{{{ ( in_array($role->id, $selectedRoles) ? ' selected="selected"' : '') }}}>{{{ $role->name }}}</option>
                    		                        	@else
                    										<option value="{{{ $role->id }}}"{{{ ( array_search($role->id, $user->currentRoleIds()) !== false && array_search($role->id, $user->currentRoleIds()) >= 0 ? ' selected="selected"' : '') }}}>{{{ $role->name }}}</option>
                    									@endif
                    		                        @endforeach
                    						</select>


                    	            	</div>

				</div>

                <div class="form-group {{{ $errors->has('unit_id') ? 'required' : '' }}}">
                    <label class="col-md-2 control-label" for="unit_id">Unit</label>
                    <div class="col-md-4">
                        <select class="form-control select2" name="unit_id">
						       <option value="{{{Input::old('unit_id', isset($user) ? $user->unit_id : null)}}}"> {{{Input::old('unit_id', isset($user) ? $user->unit->name : null)}}}</option>
                                @foreach ($units as $unit)
                                                 
                                  <option value="{{{ $unit->id }}}"> {{$unit->name}}</option>
                                   
                                @endforeach
                        </select>

                        <span class="help-block">
                            Select unit/district of a User.
                        </span>
                    </div>
                  
			<div class="col-md-offset-2 col-md-4 ">

			
				@if($mode =="edit")
				<button type="submit" class="btn btn-info pull-right">Update</button>
				@else
						<button type="submit" class="btn btn-success pull-right"><i class="glyphicon glyphicon-save"></i> Save</button>
				@endif
			</div>
                </div>

			</div>
			<!-- ./ general tab -->

		</div>
		<!-- ./ tabs content -->

		<!-- Form Actions -->
		<div class="form-group">
		
		</div>
		<!-- ./ form actions -->
	</form>
		</div>
				</div>
@stop
