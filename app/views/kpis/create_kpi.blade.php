@extends('action.layouts.default')

@section('content')
<div class="col-lg-12">
<div class="x_panel">
     <div class="x_title">
        Objective :   &nbsp; <b>{{$objective->ob_code}} - &nbsp; {{$objective->ob_description}}</b><br>
           <h2>&nbsp;&nbsp;&nbsp;&nbsp;KPI : <b>&nbsp; {{$kpi->name}}</b> &nbsp; ( {{$f_year->year}} )</h2>
        <a href="{{URL::to('kpis/objectives')}}" class="btn btn-sm btn-warning pull-right"><i class="fa fa-backward"></i></a>
        <div class="clearfix"></div>
            </div>
                            <div class="x_content">

                                                <form class="form-horizontal form-label-left" action="{{URL::to('kpis/store')}}" method="post">
                                                <div class="form-body pal">
                                                    <div class="row">
                                                       <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                                       <input type="hidden" name="objective_id" value="{{{ $objective->id }}}" />
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                               <label class="control-label col-md-6 col-sm-3">Age Group : </label>
                                                               <div class="col-md-4 col-sm-4 col-xs-12">
                                                                 <select class="form-control" required="true">
                                                                 <option></option>
                                                                 <option> < 18</option>
                                                                 <option>19 - 35</option>
                                                                 <option>36 - 45</option>
                                                                 <option>46 - 60</option>
                                                               </select>
                                                               </div>
                                                             </div>

                                                             <div class="form-group">
                                                               <label class="control-label col-md-6 col-sm-3">No of Male Staff :</label>
                                                               <div class="col-md-4 col-sm-4 col-xs-12">
                                                                 <input type="text" class="form-control" required="true"  />
                                                               </div>
                                                             </div>

                                                             <div class="form-group">
                                                               <label class="control-label col-md-6 col-sm-3">No of Female Staff :</label>
                                                               <div class="col-md-4 col-sm-4 col-xs-12">
                                                                 <input type="text" class="form-control" required="true" />
                                                               </div>
                                                             </div>

                                                             <div class="form-group">
                                                               <label class="control-label col-md-6 col-sm-3">No of Male with HIV :</label>
                                                               <div class="col-md-4 col-sm-4 col-xs-12">
                                                                 <input type="text" class="form-control" required="true" />
                                                               </div>
                                                             </div>

                                                             <div class="form-group">
                                                               <label class="control-label col-md-6 col-sm-3">No of Female with HIV :</label>
                                                               <div class="col-md-4 col-sm-4 col-xs-12">
                                                                 <input type="text" class="form-control" required="true" />
                                                               </div>
                                                             </div>
                                                            </div>


                                                            <div class="col-md-6">
                                                            <div class="form-group">
                                                               <label class="control-label col-md-6 col-sm-3">Quarter :</label>
                                                               <div class="col-md-4 col-sm-4 col-xs-12">
                                                                 <select class="form-control">

                                                                 </select>
                                                               </div>
                                                             </div>

                                                             <div class="form-group">
                                                               <label class="control-label col-md-6 col-sm-3">Zone :</label>
                                                               <div class="col-md-4 col-sm-4 col-xs-12">
                                                                 <select class="form-control">

                                                                 </select>
                                                               </div>
                                                             </div>

                                                             <div class="form-group">
                                                               <label class="control-label col-md-6 col-sm-3">Station :</label>
                                                               <div class="col-md-4 col-sm-4 col-xs-12">
                                                                 <select class="form-control">

                                                                 </select>
                                                               </div>
                                                             </div>
                                                             <div class="form-group">
                                                               <label class="control-label col-md-6 col-sm-3">Remark if any :</label>
                                                               <div class="col-md-4 col-sm-4 col-xs-12">
                                                                 <textarea class="form-control">

                                                                 </textarea>
                                                               </div>
                                                             </div>
                                                            </div>



                                                    </div>
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
                                        </div>
                                    </div>
                               
                    </div>
                <!--END CONTENT-->
                </section>

               @stop