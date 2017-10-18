@extends('action.layouts.default')

@section('content')
<div class="col-lg-12">
<div class="panel panel-green">
    <div class="panel-heading">Projections
         <b class="pull-right"><a class="btn btn-primary" href="{{URL::to('projections/create')}}" >Fill Projections</a></b>
    </div>
    <div class="panel-body">
        <table class="table dt table-hover table-striped">
            <thead>
            <tr>
                <th>Item Code</th>
                <th>Type of Fees</th>
                <th>Projection <br>2015/2015</th>
                <th>Projection <br>2016/2017</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($projections as $item)
            <tr>
                <td>{{$item->item_code}}</td>
                <td><a style="color: #000;"  title="Click to View full Details" href="{{URL::to('projections/show/'.$item->id)}}">{{$item->type_of_fee}}</a> </td>
                <td>{{$item->current_year}}</td>
                <td>{{$item->projected_year}}</td>
                <td><a href="{{URL::to('projections/edit/'.$item->id)}}" class="btn">Feed</a> </td>
            </tr>
            @endforeach
            </tbody>

</table>

@if($projections->count() > 0)
 <div class="row no-print">
                                        <div class="col-xs-12">
                                          <a href="{{URL::to('mybudget/csv')}}"  class="btn btn-default pull-left"><i class="fa fa-print"></i> Generate CSV</a>
                                          <a href="{{URL::to('mybudget/excel')}}" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Generate Excel</a>
                                        </div>
                                      </div>
                                      @endif
                                      <hr>
                                      <hr>

                </div>
                </div>
                </div>


@stop