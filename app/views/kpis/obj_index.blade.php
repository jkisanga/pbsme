@extends('action.layouts.default')


@section('content')
            <div class="col-lg-12"><div class="x_panel">
                        <div class="x_title">
                      <h2>List of Key Performance Indicators</h2>
                      <div class="clearfix"></div>
            </div>

                            <div class="x_content">
                                <table class="table table-hover table-bordered jambo_table bulk_action " >
                                    <thead>
                                    <tr>
                         <th>KPI Code</th>
                         <th >KPI Name</th>
                         <th>Plan</th>
                         <th >Action</th>
                     </tr>
                     </thead>
                     <tbody>
                     @foreach($objectives as $item)
                     <tr>

                    <td colspan="4"><b> {{$item->ob_code}} - {{$item->ob_description}}</b>


                    </td>
                    </tr>
                     @foreach(Kpi::where('objective_id', '=', $item->id)->get() as $item2)
                    <tr >
                    <td cass="active">{{$item2->code}}</td>
                    <td class="warning">{{$item2->name}}</td>
                    <td class="active">{{$item2->strategic_plan}}</td>
                    <td class="">
                     <a href="{{URL::to('kpiEvaluation/create/'.$item2->id)}}" >Manage</a>|
					  	@if( Auth::user()->hasRole('supermanager') )
						<a href="{{URL::to('kpiEvaluation/zoneReport',$item2->id)}}">Zonal Reports</a>|
						<a href="{{URL::to('kpiEvaluation/report',$item2->id)}}">Overall Reports</a>
						@endif
                    </td>
                    </tr>
                     @endforeach
                    @endforeach
                       </tbody>
                </table>
                </div>
                </div>
</div>


                    @stop
