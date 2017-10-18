@extends('action.layouts.default')

@section('content')
<div class="col-lg-12">
                        <div class="panel panel-green">
                            <div class="panel-heading"><a class="" href="{{URL::to('personal_emoluments/getTemplate')}}" >Download Current Template</a>
                            </div>
                            <div class="panel-body">
<form method="post" action="{{URL::to('personal_emoluments/storeExcel')}}" enctype = "multipart/form-data" >
 <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    <div class="col-lg-12">
        <div class="col-md-6">
        <div class="form-group">
            <div class="input-icon right">
          <b>Select File</b>     <input type="file" name="file_name" class="form-control"  />
             </div>
        </div>
        {{ $errors->first('path', '<span class="help-inline" style="color:red">:message</span>') }}
    </div>
      <div class="col-md-6">
      <div class="form-group pull-left">
      <br />
     <input  type="submit"  class="btn btn-primary" value="Upload" /></div>
      </div>
    </div>
    </form>
    </div>
    </div>
    </div>
    @stop