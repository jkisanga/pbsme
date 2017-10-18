@extends('action.layouts.default')

@section('content')
<section class="content-header">
        </section>
<!-- Main content -->
        <section class="content">
		
                                   <div class="panel panel-green">
								   
								   <div class="panel-heading">
									<h5>Update Financial Year <a class="btn btn-primary pull-right" href="{{URL::to('financial_year/index')}}">Back to List</a> </h5>
									
									</div>

                                            <div class="panel-body pan">
                                                <form action="{{URL::to('financialYear/update/'.$post->id)}}" method="post">
												 <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                                <div class="form-body pal">
                                                   	<div class="row">
									<div class="col-md-2">
											<label>Financial Year</label>
									</div>
									 <div class="col-md-2">
										
										 <div class="form-group">                                                                                                                
											<input  type="text"  name="year" class="form-control" value="{{$post->year}}" />
											 {{ $errors->first('year', '<span class="help-inline" style="color:red">:message</span>') }}
											</div>
									 </div>
									 
									 <div class="col-md-2">
											<label>Projection Percentage</label>
									</div>
									 <div class="col-md-2">
										
										 <div class="form-group">                                                                                                                
											<input  type="text"  name="projection_percentage" class="form-control" value="{{$post->projection_percentage}}" />
											 {{ $errors->first('projection_percentage', '<span class="help-inline" style="color:red">:message</span>') }}
											</div>
									 </div>
                                  <div class="col-md-4">
									
                                       
											 <div class="form-group">
											<input  type="submit"  class="btn btn-primary" value="Update" />
											</div>
									
                                    </div>
							
                            </div>
                                                    <hr />
                                                </div>
                                                </form>
                                            </div>
                                        </div>

                </section>

               @stop