@extends('action.layouts.default')


@section('content')
<div class="col-lg-12">
                        <div class="panel panel-green">
                            <div class="panel-heading">List of Revenue Category
                                 <b class="pull-right"><a class="btn-sm btn btn-primary" href="{{URL::to('revenueCategory/create')}}" >Add Revenue Category</a></b>

                            </div>
                            <div class="panel-body">
                                <table class="table dt table-hover table-striped table-bordered">
                                    <thead>
                                    <tr>
                         {{--<th>Item Code</th>--}}
                         <th> Description of Revenue</th>
                         <th>Action</th>
                     </tr>
                     </thead>
                     <tbody>
                     @foreach($items as $item)
                     <tr>
                         {{--<td>{{$item->item_code}}</td>--}}
                         <td>{{$item->name}}</td>
                         <td class="col-lg-2">
                        <a class="btn btn-sm btn-info" href="{{URL::to('revenueCategory/addRefSubmission/'.$item->id)}}" >Revenues</a>
                        <a class="btn btn-sm btn-default" href="{{URL::to('revenueCategory/edit/'.$item->id)}}" ><i class="fa fa-pencil"></i> Edit</a>
                      </td></tr>
                     @endforeach
                    </tbody>
                                    </table>
                                    </div>
                                    </div>
                                    </div>                
                    @stop