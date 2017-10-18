@extends('action.layouts.default')

     @section('content')
     <div class="col-lg-12">
                             <div class="panel panel-green">
                                 <div class="panel-heading">
                                 List of Objectives
                                 </div>
                                 <div class="panel-body">
                                     <table class=" dt table table-hover table-striped">
                                         <thead>
                                         <tr>
                                             <th>Code</th>
                                             <th>Description</th>
                                             <th>Financial Year</th>
                                             <th>Action</th>
                                         </tr>
                                         </thead>
                                         <tbody>
                                         @foreach($list_objective as $item)
                                         <tr>
                                             <td>{{$item->ob_code}}</td>
                                             <td>{{$item->ob_description}}</td>
                                             <td>{{$item->financial->year}}</td>
                                             <td><a href="{{URL::to('add_target/'.$item->id)}}" class="badge badge-info">Add Target</a> </td>
                                         </tr>
                                         @endforeach
                                         </tbody>
                                         </table>
                                         </div>
                                         </div>
                                         </div>


     @stop