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
          <h2> <b>{{$refSubmission->item_code}} - {{$refSubmission->type_of_fee}}</b></h2>
            <a href="{{URL::to('revenueCategory/addRefSubmission/'.$refSubmission->id)}}" class="btn btn-sm btn-warning pull-right"><i class="fa fa-backward"></i></a>
             <div class="clearfix"></div>
                              </div>
                                    <div class="x_content">
                <form action="{{URL::to('revenueCategory/postClass')}}" method="post">
                <div class="form-body pal">
                 <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                 <input type="hidden" name="ref_submission_id" value="{{{ $refSubmission->id }}}" />
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                     <label for="inputName" class="control-label">
                                             Class </label>
                        <div class="input-icon right">
                        <input type="text" name="class" class="form-control" required="true" />
                            </div>
                    </div>
                </div>
                {{--<div class="col-md-2">--}}
                    {{--<div class="form-group">--}}
                     {{--<label for="inputName" class="control-label">--}}
                                             {{--<b>Rate</b> </label>--}}
                        {{--<div class="input-icon right">--}}
                {{--<input type="text" name="rate" class="form-control" required="true" />--}}
                            {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            <div class="col-md-2">
              <div class="form-group "><br>
                      <button  type="submit"  class="btn btn-primary btn-sm"  ><i class="fa fa-save"></i> Save</button></div>
            </div>
                                                </div>
                                                </div>
                                                </form>
                                                <hr />

                                                  <table class="table table-hover table-striped table-bordered">
                                                        <thead>
                                                        <tr>
                                                           <th>Class</th>
                                                           {{--<th>Rate</th>--}}
                                                           <th class="col-lg-2">Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                        <tr>
                                                        @foreach(RefSubmissionClass::where('ref_submission_id', '=',$refSubmission->id)->get() as $item2)
                                                        <td >{{$item2->class}}</td>
                                                        {{--<td>{{$item2->rate}}</td>--}}
                                                      <td class="col-lg-2">
                                                       <a class="btn btn-sm btn-info" href="{{URL::to('revenueCategory/editClass/'.$item2->id)}}" ><i class="fa fa-pencil"></i></a>
                                                      <a class="btn btn-sm btn-danger" href="{{{ URL::to('revenueCategory/deleteClass/'.$item2->id)}}}" onclick="return confirm('Are you sure?')" ><i class="fa fa-remove"></i></a>
                                                      </td>

                                                        </tr>@endforeach
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                <!--END CONTENT-->
               @stop