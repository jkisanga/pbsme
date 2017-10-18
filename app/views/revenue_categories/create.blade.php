@extends('action.layouts.default')

@section('content')
<section class="content-header">
        Revenue Category

        </section>
<!-- Main content -->
        <section class="content">
                <!--BEGIN CONTENT-->
                <div class="page-content">
                    <div id="tab-general">
                        <div class="row mbl">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="panel panel-green">

                                            <div class="panel-body pan">
                                                <form action="{{URL::to('revenueCategory/store')}}" method="post">
                                                <div class="form-body pal">
                                                    <div class="row">
                                                       <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                                        {{--<div class="col-md-2">--}}
                                                            {{--<div class="form-group">--}}
                                                            {{--<label>Item Code</label>--}}
                                                                {{--<div class="input-icon">--}}
                                                                    {{--<input  type="text"  name="item_code" class="form-control" /></div>--}}
                                                                    {{--{{ $errors->first('item_code', '<span class="help-inline" style="color:red">:message</span>') }}--}}
                                                            {{--</div>--}}
                                                        {{--</div>--}}
                                                         <div class="col-md-6">
                                                            <div class="form-group">
                                                            <label>Description of Revenue</label>
                                                                <div class="input-icon">
                                                                    <input  type="text"  name="name" class="form-control" /></div>
                                                                    {{ $errors->first('name', '<span class="help-inline" style="color:red">:message</span>') }}
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                        <label></label>
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
                </section>

               @stop