@extends('action.layouts.default')

@section('content')
<div class="col-lg-12">
                        <div class="panel panel-green">
                            <div class="panel-heading">Targets</div>
                            <div class="panel-body">
                                <table class=" dt table table-hover table-striped">
                                    <thead>
                                    <tr>
                                        <th>Activity No</th>
                                        <th>Description</th>
                                        <th>Total Budget</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($list_activities as $item)
                                    <tr>
                                        <td>{{$item->activity_no}}</td>
                                        <td>{{$item->a_description}}</td>
                                        <td>{{$item->a_budget}}</td>
                                        <td>{{$item->start_date}}</td>
                                        <td>{{$item->end_date}}</td>
                                        <td><span class="badge badge-info">Approved</span></td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                </table>
                </div>
                </div>
                </div>


@stop