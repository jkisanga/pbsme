@extends('action.layouts.default')

@section('content')
<section class="content-header">
        </section>
<!-- Main content -->
        <section class="content">


                                        <div class="panel panel-green">

                                            <div class="panel-body pan">
                                                <form action="{{URL::to('financialYear/storeActivate/'.$post->id)}}" method="post">
                                                <div class="form-body pal">
                                                    <div class="row">
                                                       <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                                        <input  type="hidden"  name="year" class="form-control" value="{{$post->year}}" />
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                            <label>Year</label>
                                                                <div class="input-icon">
                                                                    <input  type="text"  class="form-control" value="{{$post->year}}" readonly /></div>

                                                                    </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                        <label></label>
                                                            <div class="form-group">
                                                                    <input  type="submit"  class="btn btn-primary" value="Activate" /></div>
                                                        </div>
                                                    </div>
                                                    <hr />
                                                </div>
                                                </form>
                                            </div>
                                        </div>

                </section>

               @stop