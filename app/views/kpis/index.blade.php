@extends('action.layouts.default')


@section('content')
<div class="col-lg-12">
<div class="x_panel">
     <div class="x_title">
           <h2>List of Key Performance Indicators</h2>

           <div class="clearfix"></div>
            </div>

                            <div class="x_content">
                                <table class="table table-hover table-bordered dt jambo_table bulk_action " >
                                    <thead>
                                    <tr>
                         <th>KPI Code</th>
                         <th >KPI Name</th>
                         <th>Plan</th>
						 <th>Action</th>
                     </tr>
                     </thead>
                     <tbody>
                     @foreach($objectives as $item)
                     <tr>

                    <td colspan="4"><b> {{$item->ob_code}} - {{$item->ob_description}}</b>

                     <a class="btn btn-sm btn-info pull-right" href="{{URL::to('kpis/create/'.$item->id)}}" ><i class="fa fa-plus-square"></i> Add Indicator</a>
                    </td>
                    </tr>
                     @foreach(Kpi::where('objective_id', '=', $item->id)->get() as $item2)
                    <tr >
                    <td cass="active">{{$item2->code}}</td>
                    <td class="warning">{{$item2->name}}</td>
                    <td class="active">{{$item2->strategic_plan}}</td>
					<td> <a class="btn btn-sm btn-primary pull-right" href="{{URL::to('kpis/fields/'.$item2->id)}}" ><i class="fa fa-plus"></i>Fields</a></td>
                    </tr>
                     @endforeach
                    @endforeach
                       </tbody>
                </table>
                </div>
                </div>
                </div>


                    @stop
