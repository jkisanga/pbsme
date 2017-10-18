@extends('action.layouts.default')

@section('content')
<section class="content-header">
        Unit Form

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
                                                <form action="{{URL::to('units/update/'. $unit->id)}}" method="post">
                                                <div class="form-body pal">
                                                    <div class="row">
                                                       <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                            <label>Zone Name</label>
                                                                <div class="input-icon">
                                                                <select name="zone_id" class="form-control">
                                                                <option value="" disabled></option>
                                                                @foreach($zones as $zone)
                                                                <option value="{{$zone->id}}">{{$zone->zone_name}} ({{$zone->short_name}})</option>
                                                                @endforeach
                                                                </select>
                                                                    </div>
                                                                    {{ $errors->first('zone_id', '<span class="help-inline" style="color:red">:message</span>') }}
                                                            </div>
                                                        </div>
                                                         <div class="col-md-4">
                                                            <div class="form-group">
                                                            <label>Name</label>
                                                                <div class="input-icon">
                                                                    <input  type="text" value="{{$unit->name}}" name="name" class="form-control" /></div>
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