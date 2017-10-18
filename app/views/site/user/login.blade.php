@extends('action.layouts.login')

{{-- Content --}}
@section('content')

<form method="POST" action="{{ URL::to('user/login') }}" >
<input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div id="loginarea">
                <h6>{{Lang::get('site.sitename')}}</h6>
                <hr/>
                <div class="row">
                    <div class="col-md-4">
                        <div class="image">
                            <img src="{{asset('asset/img/logo.jpg')}}" class="img-responsive img-rounded" />
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="username">Email</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="email" required value="{{{Input::old('email')}}}" />
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="password" required />
                        </div>
                    </div>
                </div>
                <hr/>
                <div class="row">
                   
                    <div class="col-md-2 pull-right">
                        <input type="submit" class="btn btn-success" value="Login">
                    </div>
                </div>
            </div>
        </form>

@stop
