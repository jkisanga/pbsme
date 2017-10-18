@extends('action.layouts.default')

@section('content')
<section class="content-header">
       Personal Emolument
        </section>
<!-- Main content -->
        <section class="content">
                <!--BEGIN CONTENT-->
                <div class="page-content">
<div class="col-lg-12">
    <div class="panel panel-green">

        <div class="panel-body">
            <form action="{{URL::to('emoluments/store')}}" method="post">
                <div class="row">
                   <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                    <div class="col-md-6">
                        <div class="form-group">
                        <label>Code No</label>
                            <div class="input-icon">
                                <input  type="text"  name="code_no" class="form-control" placeholder="eg. TZ 3005 Chief Executive" /></div>
                                {{ $errors->first('code_no', '<span class="help-inline" style="color:red">:message</span>') }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label>Designation</label>
                            <div class="input-icon">
                                <input  type="text"  name="designation" class="form-control" placeholder="eg. Chief Executive" /></div>
                                {{ $errors->first('designation', '<span class="help-inline" style="color:red">:message</span>') }}
                        </div>
                    </div>

                </div>
                <div class="row">
                  <div class="col-md-6">
                                    <div class="form-group">
                                    <label>Salary Scale</label>
                                        <div class="input-icon">
                                            <input  type="text"  name="salary_scale" class="form-control" placeholder="eg. TFSS 13" /></div>
                                            {{ $errors->first('salary_scale', '<span class="help-inline" style="color:red">:message</span>') }}
                                    </div>
                                </div>
                 <div class="col-md-6">
                <label></label>
                    <div class="form-group">
                            <input  type="submit"  class="btn btn-primary pull-right" value="Submit" /></div>
                </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</section>

@stop