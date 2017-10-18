@extends('action.layouts.default')
@section('content')
<div class="panel panel-grey">
                            <div class="panel-heading">Budget and Details of Activities</div>
                            <div class="panel-body">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Performance budget Code</th>
                                        <th>Activity Description</th>
                                        <th>Item Code</th>
                                        <th>Input Code</th>
                                        <th>Input Description</th>
                                        <th>Unit of Measure</th>
                                        <th>Unit Cost (TZS)</th>
                                        <th>No. of Unit</th>
                                        <th>Total Cost (TZS)</th>
                                    </tr>

                                    </thead>
                                    <tbody>
                                     <tr>
                                    <td colspan="1">{{$objective->ob_code}}</td>
                                    <td colspan="8">{{$objective->ob_description}}</td>
                                    </tr>
                                    @foreach($target_list as $item)
                                     <tr>
                                    <td colspan="1" class="active">{{$item->target_no}}</td>
                                    <td colspan="8">{{$item->ta_description}}</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td>1</td>
                                        <td class="active">active</td>
                                        <td class="success">success</td>
                                        <td class="warning">warning</td>
                                        <td class="danger">danger</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td class="active">active</td>
                                        <td class="success">success</td>
                                        <td class="warning">warning</td>
                                        <td class="danger">danger</td>
                                    </tr>

                                    </tbody>
                                    </table>
                                    </div>
                                    </div>



@stop