@extends('action.layouts.default')

@section('content')
        <section class="content">
                <div class="row">

  <div class="col-lg-12">

                                        <div class="panel panel-green"><div class="col-md-5"><h4>Zone :<b> {{$zone->zone_name}} ({{$zone->short_name}})</b> </h4></div>
                                                <form action="{{URL::to('zones/storeUnit/' .$zone->id  )}}" method="post">
                                                <div class="form-body pal">
                                                    <div class="row" style="background-color: #fafaf1;">
                                                       <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                                       <input type="hidden" name="zone_id" value="{{{ $zone->id }}}" />
                                                         <div class="col-md-4">
                                                            <div class="form-group">
                                                            <label>Add New Unit/District</label>
                                                                <div class="input-icon">
                                                                    <input  type="text"  name="name" class="form-control" placeholder="Unit name" /></div>
                                                                    {{ $errors->first('name', '<span class="help-inline" style="color:red">:message</span>') }}
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                        <label></label>
                                                            <div class="form-group">
                                                                    <input  type="submit"  class="btn btn-primary" value="Submit" /></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </form>
                                        </div>

                                            <div class="panel-body">
                                                <table class="table dt table-hover table-striped table-bordered table-responsive ">
                                                    <thead>
                                                    <tr>
                                         <th> Name</th>
                                         <th>status</th>
                                         <th data-sortable="false">Action</th>
                                     </tr>
                                     </thead>
                                     <tbody>
                                     @foreach($units as $item)
                                     <tr>
                                         <td>{{$item->name}}</td>
										   <td>
										 @if($item->deleted == true)
											 <label class="label label-danger">Disabled</label>
											 @else
												 <label class="label label-success">Enabled</label>
											 @endif
										</td>
                                         <td class="col-lg-2">
                                         <a href="{{URL::to('zones/edit_unit/'.$item->id)}}" >Edit</a>
                                     </td>
                                     </tr>
                                     @endforeach
                                    </tbody>
                                                    </table>
                                                    </div>
                                                    </div>
                                                    </div>
                </section>

               @stop