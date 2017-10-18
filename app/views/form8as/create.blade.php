@extends('action.layouts.default')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-green">
            <div class="panel-heading">
                Feed Submission</div>
            <div class="panel-body pan">
                <form action="{{URL::to('projections/update/'. $projection->id)}}" method="post">
                <div class="form-body pal">
                 <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
<div class="row">
<div class="box-body">
                  <div class="row">
                    <div class="col-xs-3"><label>Select Designation</label>
                    <section class="form-control" name="ref_id">
                    <option></option>
                    @foreach()
                    </section>
                      <input type="text" class="form-control" readonly name="item_code" value="{{$projection->item_code}}">
                    </div>
                    <div class="col-xs-8"><label>Type of Fees</label>
                      <input type="text" class="form-control" readonly name="type_of_fee" value="{{$projection->type_of_fee}}">
                    </div>
                  </div><br />
                  <h4>REVENUE COLLECTION PROJECTION 2016/2017  (TSHS)</h4><br />

                   <div class="row">
                  <div class="col-xs-3"><label>PROJECTION 2015/2016</label>
                    <input type="text" class="form-control" name="current_year" value="{{$projection->current_year}}">
                  </div>
                  <div class="col-xs-3"><label>PROJECTION 2016/2017</label>
                    <input type="text" class="form-control" name="projected_year" value="{{$projection->projected_year}}" >
                  </div>
                </div>

                </div>
                </div>
                </div><hr/>
                <div class="box-footer">
                                    <button type="submit" class="btn btn-default">Cancel</button>
                                    <button type="submit" class="btn btn-info pull-right">Update</button>
                                  </div>
 </form>
 </div>
</div>
</div>
</div>
</div>
 @stop