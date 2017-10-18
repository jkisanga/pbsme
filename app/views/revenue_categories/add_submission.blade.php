@extends('action.layouts.default')

@section('content')
                <!--BEGIN CONTENT-->
<div class="page-content">
<div id="tab-general">
<div class="row mbl">
<div class="row">
    <div class="col-lg-12">
       <div class="x_panel">
                         <div class="x_title">
            {{--Item Code :  <b>{{$submission->item_code}}</b> <br> --}}
          <h2> <b style="color: sandybrown">{{$submission->name}}</b> Items</h2>
            <a href="{{URL::to('revenueCategory/index')}}" class="btn btn-sm btn-warning pull-right"><i class="fa fa-backward"></i></a>
             <div class="clearfix"></div>
              </div>
                <div class="x_content">
                <form action="{{URL::to('revenueCategory/postRefSubmission/'. $submission->id)}}" method="post">
                <div class="form-body pal">
                 <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                     <label for="inputName" class="control-label">
                            <b>Item Code</b> </label>
                        <div class="input-icon right">
                        <input type="text" name="item_code" class="form-control" required="true" />
                            </div>
                    </div>
                    {{ $errors->first('item_code', '<span class="help-inline" style="color:red">:message</span>') }}
                </div>
                <div class="col-md-10">
                    <div class="form-group">
                     <label for="inputName" class="control-label">
                       <b>Description of Revenue</b> </label>
                        <div class="input-icon right">
                <input type="text" name="type_of_fee" class="form-control" required="true" />
                            </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                     <label class="control-label">
                      Royalty (%) </label>
                        <div class="input-icon right">
                <input type="text" name="royalty" class="form-control" required="true" />
                            </div>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                     <label class="control-label">
                      TaFF (%) </label>
                        <div class="input-icon right">
                <input type="text" name="taff" class="form-control" required="true" />
                            </div>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                     <label class="control-label">
                      VAT (%) </label>
                        <div class="input-icon right">
                <input type="text" name="vat" class="form-control" required="true" />
                            </div>
                    </div>
                </div>

                <div class="col-md-1">
                    <div class="form-group">
                     <label class="control-label">
                     CESS (%) </label>
                        <div class="input-icon right">
                <input type="text" name="cess" class="form-control" required="true" />
                            </div>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                     <label class="control-label">
                     TREE (%) </label>
                        <div class="input-icon right">
                <input type="text" name="tree" class="form-control" required="true"  />
                            </div>
                    </div>
                </div>
                 <div class="col-md-3">
                                    <div class="form-group">
                                     <label class="control-label">
                                      LMDA <small>(in amount or percent)</small> </label>
                                        <div class="input-icon right">
                                <input type="text" name="lmda" class="form-control" required="true" placeholder=" amount or percent" />
                                            </div>
                                    </div>
                                </div>
                 <div class="col-md-2">
                                    <div class="form-group">
                                    <br>
                                        <div class="input-icon right pull-right">
                                        <button  type="submit"  class="btn btn-primary btn-sm"  ><i class="fa fa-save"></i> Save</button>
                                            </div>
                                    </div>
                                </div>
            <div class="col-md-12">
 <i style="color: red">fill numerical percent / amount in box, put zero (0) if no percent / amount deducted. </i>


            </div>
           </div>
                </div>


                </form>
                </div>

<div class="">
    <table class="table table-hover table-striped table-bordered dt">
        <thead>
        <tr>
            <th class="">Item Code</th>
            <th>Description of Revenue </th>
            <th>Royalty</th>
            <th>Taff</th>
            <th>VAT</th>
            <th>CESS</th>
            <th>TREE</th>
            <th>LMDA</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($refSubmissions as $item)
        <tr>
            <td>{{$item->item_code}}</td>
            <td colspan="">{{$item->type_of_fee}}</td>
            <td >{{$item->royalty}} %</td>
            <td colspan="">{{$item->taff}} %</td>
            <td colspan="">{{$item->vat}} %</td>
            <td colspan="">{{$item->cess}} %</td>
            <td colspan="">{{$item->tree}} %</td>
            @if($item->lmda > 100)
            <td colspan="">{{$item->lmda}} TZS</td>
            @else
            <td colspan="">{{$item->lmda}} %</td>
            @endif
            <td >
              <a class="btn btn-sm btn-info" href="{{URL::to('revenueCategory/classes/'.$item->id)}}" >Classes</a>
              <a class="btn btn-sm btn-default" href="{{URL::to('revenueCategory/editRefSubmission/'.$item->id)}}" ><i class="fa fa-pencil"></i> </a>
                 {{--<li><a href="{{{ URL::to('revenueCategory/deleteRefSubmission/'.$item->id)}}}" onclick="return confirm('Are you sure?')" >Delete</a></li>--}}

            </td>
            </tr>
            @if(count(RefSubmissionClass::where('ref_submission_id', '=',$item->id)->get()) > 0)
            <tr>
            <th></th>
            <th>Classes</th>
            <th>Rate</th>

            </tr>@endif
            <tr>
            @foreach(RefSubmissionClass::where('ref_submission_id', '=',$item->id)->get() as $itm2)

            <td ></td>
            <td >{{$itm2->class}}</td>
            <td >{{$itm2->rate}}</td>



            </tr>@endforeach

            @endforeach
            </tbody>
            </table>

</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                <!--END CONTENT-->
               @stop