@extends('...admin.layouts.action')

@section('content')
                <!--BEGIN CONTENT-->
                <div class="page-content">
                    <div id="tab-general">
                        <div class="row mbl">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="panel panel-green">
                                            <div class="panel-heading">
                                                Financial Year Form</div>
                                            <div class="panel-body pan">
                                                <form action="{{URL::to('store_year')}}" method="post">
                                                <div class="form-body pal">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                                            <div class="form-group">
                                                                <div class="input-icon">
                                                                    <i class="fa fa-user"></i>
                                                                    <input  type="text" placeholder="format e.g 2015/2016" name="year" class="form-control" /></div>
                                                                    {{ $errors->first('year', '<span class="help-inline" style="color:red">:message</span>') }}
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                    <input  type="submit"  class="btn btn-primary" value="Submit" /></div>
                                                        </div>
                                                    </div>
                                                    <hr />
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <!--END CONTENT-->
               @stop