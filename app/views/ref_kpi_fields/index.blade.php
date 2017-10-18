@extends('action.layouts.default')

@section('content')
<div class="col-lg-12">
<div class="x_panel">
     <div class="x_title">
           <h2>List of Kpi Fields</h2>
             <a href="{{URL::to('refKpiFields/create')}}" class="pull-right btn btn-primary btn-small">Add New</a>
           <div class="clearfix"></div>
            </div>

                            <div class="x_content">
                                <table class="table table-hover table-bordered dt jambo_table bulk_action " >
                                    <thead>
                                    <tr>
                         <th> Name</th>
                         <th >Label</th>
                         <th>Data type</th>
                         <th>Action</th>
                     </tr>
                     </thead>
                     <tbody>
                     @foreach($fields as $field)

                    <tr >
                    <td cass="active">{{$field->name}}</td>
                    <td class="warning">{{$field->label}}</td>
                    <td class="active">{{$field->data_type}}</td>
                    <td><a href="<?php echo URL::to('refKpiFields/delete',$field->id)?>" class="btn btn-danger" onclick="return confirm('are you sure?')"> Remove</a>
					
					</td>
                    </tr>
                     @endforeach

                       </tbody>
                </table>
                </div>
                </div>
                </div>


                    @stop
