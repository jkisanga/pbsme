@extends('action.layouts.default')


@section('content')
<div class="col-lg-12">
                        <div class="panel panel-green">
                            <div class="panel-heading">Stations
                                 <b class="pull-right"><a class="btn btn-primary" href="{{URL::to('zones/create')}}" >Add Station</a></b>

                            </div>
                            <div class="panel-body">
                                <table class="dt table table-bordered dtable">
                                    <thead>
                                    <tr>
                         <th>Station Name</th>
                         <th>Acronym</th>
                         <th>Action</th>
                     </tr>
                     </thead>
                     <tbody>
                     @foreach($zones as $item)
                     <tr>
                         <td>{{$item->zone_name}}</td>
                         <td>{{$item->short_name}}</td>
                         <td class="col-lg-2">
                         <div class="dropdown">
                           <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                             Options
                             <span class="caret"></span>
                           </button>
                           <ul class="dropdown-menu " aria-labelledby="dropdownMenu1">
                             <li><a href="{{URL::to('zones/unit/'.$item->id)}}" >Units/Districts</a></li>
                             <li><a href="{{URL::to('zones/edit/'.$item->id)}}" >Edit Zone</a></li>
		          {{--<li><a href="{{{ URL::to('zones/delete/'.$item->id)}}}" onclick="return confirm('Are you sure?')" >Delete</a></li>--}}

                      </ul>
                     </div></td></tr>
                     @endforeach
                    </tbody>
                                    </table>
                                    </div>
                                    </div>
                                    </div>


                    @stop
