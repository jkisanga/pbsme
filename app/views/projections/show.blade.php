@extends('action.layouts.default')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-green" style="background-color: rgba(50, 13, 116, 0.04)">
            <div class="panel-heading">
                Feed Submission</div>
            <div class="panel-body pan">
                <form action="{{URL::to('projection/update/'. $projection->id)}}" method="post">
                <div class="form-body pal">
                 <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
<div class="row">
<div class="box-body">
                  <div class="row">
                    <div class="col-xs-3"><label>Item Code</label>
                      <input type="text" class="form-control" readonly name="item_code" value="{{$projection->item_code}}">
                    </div>
                    <div class="col-xs-9"><label>Type of Fees</label>
                      <input type="text" class="form-control" readonly name="type_of_fee" value="{{$projection->type_of_fee}}">
                    </div>
                  </div><br />
                  <h4>REVENUE PROJECTION FOR 2016/2017 (TSHS)</h4><br />

                   <div class="row">
                  <div class="col-xs-3"><label>Unit Price (Tshs.)</label>
                    <input type="text" class="form-control" name="unit_price" value="{{$projection->current_year}}" readonly>
                  </div>
                  <div class="col-xs-3"><label>Quantity</label>
                    <input type="text" class="form-control" name="quantity" value="{{$projection->projected_year}}" readonly>
                  </div>

                </div>
                <br />

                <div class="row">
                <div class="col-xs-3"><label>Feed By</label>
                                    <input type="text" class="form-control" name="quarter_4" value="{{$projection->user->first_name }} {{$projection->user->last_name }}" readonly>
                                  </div>

                        <div class="col-xs-3"><label>Feed On</label>
                                    <input type="text" class="form-control" name="quarter_4" value="{{$projection->updated_at}}" readonly>
                                  </div>
                </div>
                </div>
                </div>
                </div><hr/>
                <div class="box-footer">
              <a href="{{URL::to('projections/index')}}" class="btn btn-primary pull-left">Back</a>
                                    <a href="{{URL::to('projections/edit/'.$projection->id)}}" class="btn btn-primary pull-right">Edit Feed</a>
                                  </div>
 </form>
 </div>
</div>
</div>
</div>
</div>
 @stop