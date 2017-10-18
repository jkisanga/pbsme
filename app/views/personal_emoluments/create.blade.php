@extends('action.layouts.default')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-green">
            <div class="panel-heading">
                 Annual Estimates {{$financial_year->year}}/{{$financial_year->year+1}}
                </div>
            <div class="panel-body pan">
                <form action="{{URL::to('personal_emoluments/store')}}" method="post">
                <div class="form-body pal">
                 <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                 <input type="hidden" name="financial_year" value="{{{ $financial_year->year}}}" />
<div class="row">
<div class="box-body">

                  <div class="row">
                    <div class="col-xs-6"><label>Select Designation</label>
                    <select name="designation" class="form-control " id="designation" >
                   <option disabled selected>Select Designation</option>
                  @foreach(RefEmolument::all() as $item)
                  <option value="{{$item->designation}}" id="{{$item->code_no}},{{$item->salary_scale}}">{{$item->designation}}</option>
                  @endforeach
                   </select>
                    </div>

                    <div class="col-xs-4"><label>Code Number</label>
                    <input type="text" name="code_no" class="form-control " id="code_no"  readonly="true" />
                     <script>
                     $('#designation').change(function() {
                                 var code = $(this).children(":selected").attr("id");
                                                                var split = code.split(",");
                                                                var code_no = split[0];
                                                                var salary_scale = split[1];
                                                                 $('#code_no').val(code_no)
                                      });
                    </script>
                    </div>
                    <div class="col-xs-2"><label>Salary Scale</label>
                    <input type="text" name="salary_scale" class="form-control" id="salary_scale" readonly="true" />

                     <script>
                     $('#designation').change(function() {
                                var code = $(this).children(":selected").attr("id");
                                var split = code.split(",");
                                var code_no = split[0];
                                var salary_scale = split[1];
                                 $('#salary_scale').val(salary_scale)
                                      });
                    </script>

                    </div>
                  </div><br /><br>
                   <div class="row">
                  <div class="col-xs-4"><label>ESTABLISHED MANNING LEVEL <br>{{$financial_year->year}}/{{$financial_year->year+1}}</label>
                    <input type="text" class="form-control" name="established_meaning_level" placeholder="eg. 1">
                     {{ $errors->first('established_meaning_level', '<span class="help-inline" style="color:red">:message</span>') }}
                  </div>
                  <div class="col-xs-4"><label>ACTUAL STRENGTH<br> {{$financial_year->year-1}}/{{$financial_year->year}}</label>
                    <input type="text" class="form-control" name="actual_strength" placeholder="eg. 1">
                     {{ $errors->first('actual_strength', '<span class="help-inline" style="color:red">:message</span>') }}
                  </div>
                  <div class="col-xs-4"><label>APPROVED ESTABLISHMENT<br> {{$financial_year->year-1}}/{{$financial_year->year}}</label>
                    <input type="text" class="form-control" name="approved_establishment" placeholder="eg. 1">
                     {{ $errors->first('approved_establishment', '<span class="help-inline" style="color:red">:message</span>') }}
                  </div>

                </div>
<br /><br>
                   <div class="row">
                  <div class="col-xs-4"><label>APPROVED ESTIMATES <br>{{$financial_year->year-1}}/{{$financial_year->year}}</label>
                    <input type="text" class="form-control" name="approved_estimate" placeholder="eg. 49560000">
                     {{ $errors->first('approved_estimate', '<span class="help-inline" style="color:red">:message</span>') }}
                  </div>
                  <div class="col-xs-4"><label>APPROVED ESTABLISHMENT<br> {{$financial_year->year}}/{{$financial_year->year+1}}</label>
                    <input type="text" class="form-control" name="approved_establishment_next" placeholder="eg. 66000000">
                     {{ $errors->first('approved_establishment_next', '<span class="help-inline" style="color:red">:message</span>') }}
                  </div>
                  <div class="col-xs-4"><label>APPROVED ESTIMATES<br> {{$financial_year->year+1}}/{{$financial_year->year+2}}</label>
                    <input type="text" class="form-control" name="approved_estimate_next" placeholder="eg. 66000000">
                     {{ $errors->first('approved_estimate_next', '<span class="help-inline" style="color:red">:message</span>') }}
                  </div>

                </div>

                </div>
                </div>
                </div><hr/>
                <div class="box-footer">
                                    <button type="submit" class="btn btn-default">Cancel</button>
                                    <button type="submit" class="btn btn-info pull-right">Submit</button>
                                  </div>
 </form>
 </div>
</div>
</div>
</div>
</div>
 @stop