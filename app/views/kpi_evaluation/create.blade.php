@extends('action.layouts.default')

@section('content')
<div class="col-lg-12">
<div class="x_panel">
     <div class="x_title">

           <h2>KPI : <b>&nbsp; {{$kpi->name}}</b> </h2>
		    <a href="{{URL::to('kpiEvaluation/unitReport',$kpi->id)}}" class="btn btn-sm btn-warning pull-right"><i class="fa fa-file"></i> Reports</a>
        <a href="{{URL::to('kpis/index')}}" class="btn btn-sm btn-warning pull-right"><i class="fa fa-backward"></i></a>
		   
        <div class="clearfix"></div>
            </div>
                  <div class="x_content" >

                        <form class="form-horizontal form-label-left" action="{{URL::to('kpiEvaluation/store')}}" method="post">
                        <div class="form-body pal" >
                              <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                               <input type="hidden" name="kpi_id" value="{{{ $kpi->id }}}" />

                              <?php foreach ($kpi->fields as $key => $value): ?>
							  
							    <?php
								

								switch($value->field->data_type){
										case "enum": ?>
									<div class="row">
										 <div class="col-md-4">
											<label>{{$value->field->label}}</label><label class="pull-right label-warning"></label>
										</div>
										 <div class="col-md-4">
											<div class="form-group {{{ $errors->has($value->field->name) ? 'has-error' : '' }}}">
											 <select name="{{$value->field->name}}" class="form-control select2">
											   <option disabled selected>Select Input</option>
											  @foreach(KpiEvaluation::getPossibleEnumValues($value->field->name) as $item)
													 @if(!in_array($item,$submitted_quarters))
																<option value="{{$item}}" id="{{$item}}">{{$item}}</option>
																
															@endif
											  @endforeach
											   </select>
											
											{{ $errors->first($value->field->name, '<span class="help-block">:message</span>') }}
											</div>
										</div>
									</div>
								<?php break; ?>
									<?php case "string": ?>
									   <div class="row">
										 <div class="col-md-4">
											<label>{{$value->field->label}}</label><label class="pull-right label-warning"></label>
										</div>
										 <div class="col-md-8">
											<div class="form-group {{{ $errors->has($value->field->name) ? 'has-error' : '' }}}">
											  <input class="form-control" type="text" name="{{$value->field->name}}">
											{{ $errors->first($value->field->name, '<span class="help-block">:message</span>') }}
											</div>
										</div>
								</div>
								<?php break; ?>
								
								<?php case "integer": ?>
								       <div class="row">
										 <div class="col-md-4">
											<label>{{$value->field->label}}</label><label class="pull-right label-warning"></label>
											</div>
										 <div class="col-md-2">
											<div class="form-group {{{ $errors->has($value->field->name) ? 'has-error' : '' }}}">
											  <input class="form-control" type="text" name="{{$value->field->name}}">
											{{ $errors->first($value->field->name, '<span class="help-block">:message</span>') }}
											</div>
										</div>
								</div>
								<?php break; ?>
								
								<?php case "boolean": ?>
								 <div class="row">
										 <div class="col-md-4">
											<label>{{$value->field->label}}</label><label class="pull-right label-warning"></label>
											</div>
										 <div class="col-md-2">
											<div class="form-group {{{ $errors->has($value->field->name) ? 'has-error' : '' }}}">
											  <input type="checkbox" class="form-control"  name="{{$value->field->name}}" value="1">
											{{ $errors->first($value->field->name, '<span class="help-block">:message</span>') }}
											</div>
										</div>
									</div>
								<?php break; ?>
								<?php case "double": ?>
								 <div class="row">
										 <div class="col-md-4">
											<label>{{$value->field->label}}</label><label class="pull-right label-warning"></label>
											</div>
										 <div class="col-md-2">
											<div class="form-group {{{ $errors->has($value->field->name) ? 'has-error' : '' }}}">
											  <input type="text" class="form-control"  name="{{$value->field->name}}" >
											{{ $errors->first($value->field->name, '<span class="help-block">:message</span>') }}
											</div>
										</div>
										</div>
								<?php break; ?>
								
								<?php } ?>
														
                              <?php endforeach; ?>
                          
                            <div class="row">
                             <div class="col-md-12">
                            <div class="form-group pull-right">
                                    <button  type="submit"  class="btn btn-primary btn-sm"  ><i class="fa fa-save"></i> Save</button>
                                    </div>
                        </div>
                            </div>
                            <hr />
                        </div>
                        </form>
                                  </div>
								  
					@if(isset($kpi->fields))
						
                        <table class="table table-hover table-bordered dt jambo_table bulk_action " >
							<thead>
							<tr>
								@foreach($kpi->fields as $field)
									
								<th>{{$field->field->label}}</th>
									
								@endforeach
								<th>Action</th>
								</tr>
							</thead>
							<tbody>
								
								<?php
								foreach($results as $result){
									echo "<tr>";
									$arr = $kpi->fields;
									
									foreach($kpi->fields as $field){
										echo "<td>".$result[$field->field->name]."</td>";
									}
								?>
									<td> <a class="btn btn-sm btn-danger" href="{{URL::to('kpiEvaluation/delete/'.$result->id)}}" onclick="return confirm('Are you sure?')">Delete</a></td>
							  <?php
									echo "</tr>";
								}
								?>
								
							</tbody>
						</table>
						  <canvas id="visualization"></canvas>
                                 </div>
						
					@endif
					
					

  </div>
</div>

                <!--END CONTENT-->
                </section>

               @stop
			   
	@section('scripts')
					
        
        <script type="text/javascript">
           if ($('#visualization').length ){

			  var ctx = document.getElementById("visualization");
			  var mybarChart = new Chart(ctx, {
				type: 'bar',
				data: {
				  labels: {{json_encode($labels)}},
				  datasets: {{json_encode($dataset)}}
				},

				options: {
				  scales: {
					yAxes: [{
					  ticks: {
						beginAtZero: true
					  }
					}]
				  }
				}
			  });

			}
        </script>
  
					@stop
