@extends('action.layouts.default')

@section('content')
 <!--BEGIN CONTENT-->

<div class="panel panel-danger">
    <div class="panel-heading">
        <h5>Pending Targets For <b>{{Auth::user()->unit->zone->zone_name}}</b> consolidation <span class="badge badge-warning"><?php echo count($pending_targets)?></span></h5>
    </div>

    <div class="panel-body">
        <table class="table table-striped table-hover table-bordered dt">
            <tr>
                <th>Target</th>
				<th>Description</th>
            </tr>
	
          <?php foreach($pending_targets as $pending){?>
			<tr>
				<td> <?php echo $pending->objective.$pending->target_no?></td>
				<td> <a href="{{URL::to('budget/zonal_consolidate',$pending->id)}}">{{$pending->ta_description}}</a></td>
             </tr>
			<?php }?>
        </table>


        </div>
    </div>
	
	@stop