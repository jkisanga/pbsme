@extends('action.layouts.default')

     @section('content')
     <div class="col-lg-12">
 <div class="panel panel-green">
     <div class="panel-heading">
     <b class="pull-right"><a class="btn btn-primary" href="{{URL::to('add_objective')}}" >Add Objective</a></b>
         <br>

     </div>
     <div class="panel-body">
         <table class=" dt table table-hover table-striped table-bordered table-responsive ">
             <thead>
             <tr>
                 <th>Code</th>
                 <th>Description</th>

                 <th>Action</th>
             </tr>
             </thead>
             <tbody>
             @foreach($list_objective as $item)
             <tr>
                 <td>{{$item->ob_code}}</td>
                 <td>{{$item->ob_description}}</td>

                   <td class="col-lg-2">
                              <div class="dropdown">
                                <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                  Options
                                  <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu " aria-labelledby="dropdownMenu1">
                                  <li><a href="{{URL::to('edit_objective/'.$item->id)}}" >Edit</a></li>

                           </ul>
                          </div></td>
             </tr>
             @endforeach
             </tbody>
             </table>
             </div>
             </div>
             </div>


@stop