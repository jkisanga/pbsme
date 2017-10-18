@extends('action.layouts.default')
@section('content')
<div class="panel panel-green"><input type="hidden" value="{{$unit= Unit::where('id', '=', Auth::user()->unit_id)->first()}}" />
                            <div class="panel-heading">TANZANIA FOREST SERVICES DRAFT BUDGET ESTIMATES FOR FINANCIAL YEAR 2016-2017 - {{$unit->unit_name}}  Unit</div>
                            <div class="panel-body">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Performance  Code</th>
                                        <th>Activity Description</th>
                                        <th>Input Code</th>
                                        <th>Input Description</th>
                                        <th>Unit of Measure</th>
                                        <th>Unit Cost (TZS)</th>
                                        <th>No. of Unit</th>
                                        <th>Total Cost (TZS)</th>
                                    </tr>

                                    </thead>
                                    <tbody>
                                    @foreach($objectives as $objective)
                                     <tr>
                                    <td colspan="1"><b>OBJECTIVE {{$objective->ob_code}}</b></td>
                                    <td colspan="8"><b>{{$objective->ob_description}}</b></td>
                                    </tr>

                                    @foreach($objective->target as $targets)
                                     <tr>
                                    <td colspan="1" class="active"><b>TARGET {{$targets->target_no}}</b></td>
                                    <td colspan="8"><b>{{$targets->ta_description}}</b></td>
                                    @foreach($activities = DB::table('tfs_activities')->where('target_id', '=', $targets->id)->where('unit_id', '=', $unit->id)->get() as $activity)
                                        <tr>
                                        <td>{{$activity->activity_no}}</td>
                                        <td>{{$activity->a_description}}</td>
                                        <td colspan="7">
                                        <table class="table table-bordered">
                                        @foreach(DB::table('tfs_items')->where('activity_id', '=', $activity->id)->get() as $input)
                                        <tbody> <tr>
                                        <td class="success">{{$input->item_code}}</td>
                                        <td class="warning">{{$input->input_description}}</td>
                                        <td class="danger">{{$input->unit_of_measure}}</td>
                                        <td class="active">{{$input->unit_cost}}</td>
                                       <td class="success">{{$input->no_of_unit}}</td>
                                       <td class="warning">{{$input->cost}}</td>
                                      <input type="hidden" {{$sum = $sum + $input->cost}} />
                                       </tr> </tbody>
                                       @endforeach
                                       <tr>
                                        <td></td>
                                        <td><b>Total Activity : {{$activity->activity_no}} </b></td><td></td><td></td><td></td><td><b>{{$activity->a_budget}}</b></td>
                                       </tr>
                                       </tr>
                                       </table>
                                        </td>

                                    </tr>
                                    </tr>

                                    @endforeach

                                     @endforeach
                                    @endforeach
                                    </tbody>

                                    </table>
                                     <div class="row no-print">
                                        <div class="col-xs-12">
                                          <a href="{{URL::to('mybudget/csv')}}"  class="btn btn-default pull-left"><i class="fa fa-print"></i> Generate CSV</a>
                                          <a href="{{URL::to('mybudget/excel')}}" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Generate Excel</a>
                                        </div>
                                      </div>
                                      <hr/>
                                    </div>
                                    </div>




@stop