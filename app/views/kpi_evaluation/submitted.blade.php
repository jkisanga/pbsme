@extends('action.layouts.default')

@section('content')
<section class="content-header">
        </section>
<!-- Main content -->
        <section class="content">

            <div class="panel panel-default">
				<div class="panel-heading">
				<h5>{{$financial_year->year}} Financial Year </h5>
				</div>
                <div class="panel-body">
                    <form action="" method="post">
                    <div class="form-body">
                        <div class="row">
                           <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                            <input  type="hidden"  name="year_id" class="form-control" value="{{$financial_year->id}}" />                         
								 </div>
							<div class="row">
							   @if(!empty($unit))
									<div class="col-md-2">
											<label>Substation/Unit</label>
									</div>
									 <div class="col-md-5">
										
										  <input  type="text"  class="form-control" value="{{$unit->name}}" readonly />
									 </div>
									 	 <div class="col-md-2">
											<div class="form-group {{{ $errors->has('quarter') ? 'has-error' : '' }}}">
											 <select name="quarter" class="form-control select2">
											   <option disabled selected>Select quarter</option>
											  @foreach(KpiEvaluation::getPossibleEnumValues('quarter') as $item)
													@if(!in_array($item,$submitted_quarters))
														<option value="{{$item}}" id="{{$item}}">{{$item}}</option>
														{{$no_pending_quarter++}}
													@endif

											  @endforeach
											   </select>
											
											{{ $errors->first('quarter', '<span class="help-block">:message</span>') }}
											</div>
										</div>
                                  <div class="col-md-2">
										@if($no_pending_quarter > 0)
											 <div class="form-group">
											<input  type="submit"  class="btn btn-primary" value="Submit" />
											</div>
										@else
											<div class="alert alert-success">Submitted</div>
										@endif
									
                                    </div>
								 @endif
                            </div>


                        </div>
                        <hr />
                          </form>
                    </div>
                </div>
				    @if(Auth::user()->hasRole('manager') || Auth::user()->hasRole('supermanager'))
						{{$kpi_submit_view}}
					@endif
                </section>

               @stop