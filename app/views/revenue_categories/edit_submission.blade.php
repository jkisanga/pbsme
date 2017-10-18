@extends('action.layouts.default')

@section('content')
                <!--BEGIN CONTENT-->
<div class="page-content">
<div id="tab-general">
<div class="row mbl">
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-grey">
            <div class="panel-heading">
            Editing
            </div>
            <div class="panel-body pan">
                <form action="{{URL::to('revenueCategory/postEditRefSubmission/'. $refSubmission->id)}}" method="post">
                <div class="form-body pal">
                 <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                     <label for="inputName" class="control-label">
                                             <b>Item Code</b> </label>
                        <div class="input-icon right">
                        <input type="text" name="item_code" class="form-control" value="{{$refSubmission->item_code}}" />
                            </div>
                    </div>
                    {{ $errors->first('item_code', '<span class="help-inline" style="color:red">:message</span>') }}
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                     <label for="inputName" class="control-label">
                                             <b>Description of Revenue</b> </label>
                        <div class="input-icon right">
                <input type="text" name="type_of_fee" class="form-control" value="{{$refSubmission->type_of_fee}}" />
                            </div>
                    </div>
                </div>
                 <div class="col-md-1">
                                    <div class="form-group">
                                     <label class="control-label">
                                      Royalty (%) </label>
                                        <div class="input-icon right">
                                <input value="{{$refSubmission->royalty}}" type="text" name="royalty" class="form-control" required="true" />
                                            </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                     <label class="control-label">
                                      TaFF (%) </label>
                                        <div class="input-icon right">
                                <input value="{{$refSubmission->taff}}" type="text" name="taff" class="form-control" required="true" />
                                            </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                     <label class="control-label">
                                      VAT (%) </label>
                                        <div class="input-icon right">
                                <input value="{{$refSubmission->vat}}" type="text" name="vat" class="form-control" required="true" />
                                            </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                     <label class="control-label">
                                      LMDA (%) </label>
                                        <div class="input-icon right">
                                <input value="{{$refSubmission->lmda}}" type="text" name="lmda" class="form-control" required="true" />
                                            </div>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                     <label class="control-label">
                                     CESS (%) </label>
                                        <div class="input-icon right">
                                <input value="{{$refSubmission->cess}}" type="text" name="cess" class="form-control" required="true" />
                                            </div>
                                    </div>
                                    </div>
            <div class="col-md-2">
              <div class="form-group"><br>
                      <button  type="submit"  class="btn-sm btn btn-primary" ><i class="fa fa-save"></i> Update</button></div>
            </div>
                                                </div>
                                                </div>
                                                </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                <!--END CONTENT-->
               @stop