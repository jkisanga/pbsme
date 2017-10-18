@extends('action.layouts.default')

@section('content')
<section class="content-header">
        </section>
<!-- Main content -->
        <section class="content">

            <div class="panel panel-default">
				<div class="panel-heading">
				<h5>Revenue Submission For Financial Year {{$financial_year->year}}  </h5>
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
                                  <div class="col-md-4">
										@if($unit_submited )
                                        <div class="alert alert-success">Submitted</div>
										@else
											 <div class="form-group">
											<input  type="submit"  class="btn btn-primary" value="Submit" />
											</div>
										@endif
                                    </div>
								 @endif
                            </div>


                        </div>
                        <hr />
                          </form>
                    </div>
                </div>
				   
                </section>

               @stop