@extends('action.layouts.default')

@section('content')
<div class="col-lg-12">
<div class="x_panel">
     <div class="x_title">

           <h2>Reports For KPI : <b>&nbsp; {{$kpi->name}}</b> </h2>
        <a href="{{URL::to('kpis/objectives')}}" class="btn btn-sm btn-warning pull-right"><i class="fa fa-backward"></i></a>
        <div class="clearfix"></div>
            </div>
                  <div class="x_content" >

                        <form class="form-horizontal form-label-left" action="{{URL::to('kpiEvaluation/report',$kpi->id)}}" method="post">
                        <div class="form-body pal" >
                            <div class="row">
                              <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                               <input type="hidden" name="kpi_id" value="{{{ $kpi->id }}}" />
						  <div class="col-xs-3 col-sm-3 col-md-3">
								<label>Financial Years</label>
								 <div class="form-group {{ $errors->has('year') ? 'has-error' : '' }}">

								   <select name="year" class="form-control select2">
								    <option value="{{$financial_year->id}}"> {{$financial_year->year}}</option>
									@foreach($years as $year )
									<option  value="{{$year->id}}">{{$year->year}}</option>
									@endforeach
								   </select>
									{{ $errors->first('year', '<span class="help-block">:message</span>') }}
								 </div>
							  </div>
								
                              <?php foreach ($kpi->fields as $key => $value): ?>
							  
							    <?php
								
								switch($value->field->data_type){
										case "enum": ?>
										 <div class="col-md-3">
											<label>{{$value->field->label}}</label><label class="pull-right label-warning"></label>
											<div class="form-group {{{ $errors->has($value->field->name) ? 'has-error' : '' }}}">
											 <select name="{{$value->field->name}}" class="form-control select2">
											   <option disabled selected>Select Input</option>
											  @foreach(KpiEvaluation::getPossibleEnumValues($value->field->name) as $item)
											  <option value="{{$item}}" id="{{$item}}">{{$item}}</option>
											  @endforeach
											   </select>
											
											{{ $errors->first($value->field->name, '<span class="help-block">:message</span>') }}
											</div>
										</div>
								<?php break; ?>
									
								
								<?php case "boolean": ?>
										 <div class="col-md-3">
											<label>{{$value->field->label}}</label><label class="pull-right label-warning"></label>
											<div class="form-group {{{ $errors->has($value->field->name) ? 'has-error' : '' }}}">
											  <input type="checkbox" class="form-control"  name="{{$value->field->name}}" value="1">
											{{ $errors->first($value->field->name, '<span class="help-block">:message</span>') }}
											</div>
										</div>
								<?php break; ?>
								
								<?php } ?>
														
                              <?php endforeach; ?>
							  
							

                            </div>
                            <div class="row">
                             <div class="col-md-12">
                            <div class="form-group pull-right">
                                    <button  type="submit"  class="btn btn-primary btn-sm"  ><i class="fa fa-search"></i> Search</button>
                                    </div>
                        </div>
                            </div>
                            <hr />
                        </div>
                        </form>
                                  </div>
								  
					@if( isset($results) && isset($kpi->fields))
						
                        <table class="table table-hover table-bordered dt jambo_table bulk_action " >
							<thead>
							<tr>
								@foreach($kpi->fields as $field)
									
								<th>{{$field->field->label}}</th>
									
								@endforeach
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
										
									echo "</tr>";
								}
								?>
								
							</tbody>
						</table>
					</div>
						  
						  
						  
						
						
</div>
				<div class="col-lg-12">
					<div class="x_panel">
								<div class="x_title">
									<h2>Graphs</h2>
									 <div class="clearfix"></div>
								</div>
								  <div class="x_content">
								  	{{$Charts}}
								  </div>
								  </div>
							</div>
</div>
					
						
						 
						 
						  
						
					
										
					@endif
				 
					



                <!--END CONTENT-->
                </section>

               @stop
			   
	
