@extends('action.layouts.default')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-green" style="background-color: rgba(50, 13, 116, 0.04)">
            <div class="panel-heading">
                Feed Submission</div>
            <div class="panel-body pan">
                <form action="{{URL::to('submissions/update/'. $submission->id)}}" method="post">
                <div class="form-body pal">
                 <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
<div class="row">
<div class="box-body">
                  <div class="row">
                    <div class="col-xs-3"><label>Item Code</label>
                      <input type="text" class="form-control" readonly name="item_code" value="{{$submission->item_code}}">
                    </div>
                    <div class="col-xs-9"><label>Type of Fees</label>
                      <input type="text" class="form-control" readonly name="type_of_fee" value="{{$submission->type_of_fee}}">
                    </div>
                  </div><br />
                  <h4>REVENUE PROJECTION FOR 2016/2017 (TSHS)</h4><br />

                   <div class="row">
                  <div class="col-xs-3"><label>Unit Price (Tshs.)</label>
                    <input type="text" class="form-control" name="unit_price" value="{{$submission->unit_price}}" readonly>
                  </div>
                  <div class="col-xs-3"><label>Quantity</label>
                    <input type="text" class="form-control" name="quantity" value="{{$submission->quantity}}" readonly>
                  </div>
                  <div class="col-xs-3"><label>Total Revenue (Tshs.)</label>
                    <input type="text" class="form-control"  name="total_revenue" value="{{$submission->total_revenue}}" readonly>
                  </div>
                </div>
                <br />
                  <h4 class="center">QUARTERLY PROJECTION (2016/2017)</h4><br />
                   <div class="row">
                  <div class="col-xs-3"><label>Quarter I</label>
                    <input type="text" class="form-control" name="quarter_1" value="{{$submission->quarter_1}}" readonly>
                  </div>
                  <div class="col-xs-3"><label>Quarter II</label>
                    <input type="text" class="form-control" name="quarter_2" value="{{$submission->quarter_2}}" readonly>
                  </div>
                  <div class="col-xs-3"><label>Quarter III</label>
                    <input type="text" class="form-control" name="quarter_3" value="{{$submission->quarter_3}}"  readonly>
                  </div>
                  <div class="col-xs-3"><label>Quarter IV</label>
                    <input type="text" class="form-control" name="quarter_4" value="{{$submission->quarter_4}}" readonly>
                  </div>
                </div><hr/>
                <br />

                </div>
                </div>
                </div><hr/>
                <div class="box-footer">
              <a href="{{URL::to('submissions/index')}}" class="btn btn-primary pull-left">Back</a>
                                    <a href="{{URL::to('submissions/edit/'.$submission->id)}}" class="btn btn-primary pull-right">Edit Feed</a>
                                  </div>
 </form>
 </div>
</div>
</div>
</div>
</div>
 @stop