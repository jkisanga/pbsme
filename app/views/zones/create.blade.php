@extends('action.layouts.default')

@section('content')
<section class="content-header">
        Station Form

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
                                                <form action="{{URL::to('zones/store')}}" method="post">
                                                <div class="form-body pal">
                                                    <div class="row">
                                                       <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                            <label>Station Name</label>
                                                                <div class="input-icon">
                                                                    <input  type="text"  name="zone_name" class="form-control" /></div>
                                                                    {{ $errors->first('zone_name', '<span class="help-inline" style="color:red">:message</span>') }}
                                                            </div>
                                                        </div>
                                                         <div class="col-md-3">
                                                            <div class="form-group">
                                                            <label>Acronym</label>
                                                                <div class="input-icon">
                                                                    <input  type="text"  name="short_name" class="form-control" /></div>
                                                                    {{ $errors->first('short_name', '<span class="help-inline" style="color:red">:message</span>') }}
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