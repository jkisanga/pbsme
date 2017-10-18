@extends('action.layouts.default')

@section('content')

  <div class="row top_tiles">           
              <div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-list-ul"></i></div>
                  <div class="count">{{count($zoneUnits)}}</div>
                  <h3>All</h3>
                  <p>{{$current_unit->zone->zone_name}} units.</p>
                </div>
              </div>
              <div class="animated flipInY col-lg-4 col-md-4  col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-check-square-o"></i></div>
                  <div class="count">{{count($submitted_budgets)}}</div>
                  <h3>Submitted</h3>
                  <p>Units submitted budget financial this Year.</p>
                </div>
              </div>
              <div class="animated flipInY col-lg-4 col-md-4  col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-minus-square"></i></div>
                  <div class="count">{{$pending}}</div>
                  <h3>Pending</h3>
                  <p>Units not submitted budget this financial Year.</p>
                </div>
              </div>
            </div>
			
   <div class="row">
      <div class="col-md-12">
			<div class="x_panel">
					<div class="x_title">
					<h2><?php echo Auth::user()->unit->zone->zone_name;?>
					<small> units/districts</small>
					</h2>
					  <div class="pull-right">								  
					     <a href="{{URL::to('budget/consolidate')}}" 
							 {{ $is_submitted ? 'onclick="return false" class=" btn btn-success submitted_notify"' : '' }}
						 class="btn btn-success">
						 <span class="fa fa-tree"></span> Consolidate</a>
						
					  </div>
					 <div class="clearfix"></div>
				</div>

				<div class="x_content">

					<table class="table table-striped table-hover table-bordered dt">
						<tr>
							<th>Unit</th>
							<th>Total Budget</th>
							<th>Submitted By</th>
							<th>Action</th>
						</tr>
						<?php
						foreach($submitted_budgets as $budget){?>
							<tr>
								<td><?php echo $budget->unit?></td>
								<td><?php echo String::formatMoney(Item::unit_grand_total($budget->unit_id,$financial_year->id))?></td>
								<td><?php echo $budget->first_name?> <?php echo $budget->last_name?> (<?php echo $budget->title?> )</td>
								<td><a href="<?php echo URL::to('budget/unlock',$budget->id)?>"
								 {{ $is_submitted ? ' disabled onclick="return false" class=" btn btn-success submitted_notify"' : '' }}
								class="btn btn-primary" onclick="return confirm('are you sure?')"> Unlock</a></td>
							</tr>
						<?php }?>
					</table>
				</div>
			</div>
		</div>
	</div>
@stop

