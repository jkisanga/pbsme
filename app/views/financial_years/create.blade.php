@extends('action.layouts.default')

@section('content')


     <div class="panel panel-default">
				<div class="panel-heading">
				<h5>Add Financial Year <a class="btn btn-primary pull-right" href="{{URL::to('financial_year/index')}}">Back to List</a> </h5>
				
				</div>
                <div class="panel-body">
                    <form action="{{URL::to('financialYear/store')}}" method="post">
                    <div class="form-body">
                        <div class="row">
                           <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                                
								 </div>
							<div class="row">
									<div class="col-md-2">
											<label>Financial Year</label>
									</div>
									 <div class="col-md-2">
										
										 <div class="form-group">                                                                                                                
											<input  type="text"  name="year" class="form-control" placeholder="eg. 2015/2016" />
											 {{ $errors->first('year', '<span class="help-inline" style="color:red">:message</span>') }}
											</div>
									 </div>
									 
									 <div class="col-md-2">
											<label>Projection Percentage</label>
									</div>
									 <div class="col-md-2">
										
										 <div class="form-group">                                                                                                                
											<input  type="text"  name="projection_percentage" class="form-control" placeholder="eg. 5" />
											 {{ $errors->first('projection_percentage', '<span class="help-inline" style="color:red">:message</span>') }}
											</div>
									 </div>
                                  <div class="col-md-4">
									
                                       
											 <div class="form-group">
											<input  type="submit"  class="btn btn-primary" value="Submit" />
											</div>
									
                                    </div>
							
                            </div>


                        </div>
                        <hr />
                          </form>
                    </div>
                </div>
				
				
				


               @stop