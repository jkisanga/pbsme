@extends('action.layouts.login')

{{-- Web site Title --}}
@section('title')

@parent
@stop

{{-- Content --}}
@section('content')
 <div class="row">
    <div class="col-lg-12 ">
                    <div class=" toppad" >
                    <form role="form" method="POST" action="">
                      <input type="hidden" name="_token" value="{{{ Session::getToken() }}}">

                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <h3 class="panel-title"> Change Password</h3>
                        </div>

                        <div class="panel-body">
                          <div class="row">
                            <div class="form-group {{{ $errors->has('old_password') ? 'required' : '' }}}">
                                
                                <div class="col-md-4">
                                <label  control-label" for="old_password">Old Password</label>
                                    <input class="form-control" type="text" name="old_password" id="FirstName" />
                                    {{ $errors->first('old_password', '<span class="text-danger">:message</span>') }}
                                </div>

                                <div class="form-group {{{ $errors->has('password') ? 'required' : '' }}}">
                                   
                                    <div class="col-md-4">
                                     <label class=" control-label" for="password">New Password</label>
                                        <input class="form-control" type="password" name="password" id="FirstName" />
                                        {{ $errors->first('password', '<span class="text-danger">:message</span>') }}
                                    </div>
                                    </div>

                                    <div class="form-group {{{ $errors->has('password_confirmation') ? 'required' : '' }}}">
                                       
                                        <div class="col-md-4">
                                         <label class=" control-label" for="password_confirmation">Confirm New Password</label>
                                            <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" />
                                            {{ $errors->first('password_confirmation', '<span class="text-danger">:message</span>') }}
                                        </div>
                                   </div>

                                   <div class="form-group">
                                   			<div class="col-md-6">
                                   			  <br>
                                  				<button type="submit" class="btn btn-success">Change Password</button>
                                   			</div>
                                   		</div>

                          </div>
                        </div>
                      </div>

                      </div>

                </form>
                    </div>
              </div>
    </div>

@stop

@section('scripts')

@stop

