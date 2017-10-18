@extends('action.layouts.default')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-green">
            <div class="panel-heading">
                 Annual Estimates {{$financial_year->year}}/{{$financial_year->year+1}}
                </div>
            <div class="panel-body pan">
                <form action="{{URL::to('personal_emoluments/postRemark/'.$post->id)}}" method="post">
                <div class="form-body pal">
                 <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                 <input type="hidden" name="financial_year" value="{{{ $financial_year->year}}}" />
<div class="row">
<div class="box-body">

                  <div class="row">
                    <div class="col-xs-6"><label>Select Designation</label>
                    <input class="form-control" value="{{$post->designation}}" readonly  />
                    </div>

                    <div class="col-xs-4"><label>Code Number</label>
                    <input type="text" name="code_no" class="form-control " id="code_no"  readonly="true" value="{{$post->code_no}}" readonly />
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
                    <input type="text" name="salary_scale" class="form-control" id="salary_scale" readonly="true" value="{{$post->salary_scale}}" readonly />
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
                    <input type="text" class="form-control" name="established_meaning_level" value="{{$post->established_meaning_level}}" readonly />
                     {{ $errors->first('established_meaning_level', '<span class="help-inline" style="color:red">:message</span>') }}
                  </div>
                  <div class="col-xs-4"><label>ACTUAL STRENGTH<br> {{$financial_year->year-1}}/{{$financial_year->year}}</label>
                    <input type="text" class="form-control" name="actual_strength" value="{{$post->actual_strength}}"  readonly  />
                     {{ $errors->first('actual_strength', '<span class="help-inline" style="color:red">:message</span>') }}
                  </div>
                  <div class="col-xs-4"><label>APPROVED ESTABLISHMENT<br> {{$financial_year->year-1}}/{{$financial_year->year}}</label>
                    <input type="text" class="form-control" name="approved_establishment" value="{{$post->approved_establishment}}" readonly />
                     {{ $errors->first('approved_establishment', '<span class="help-inline" style="color:red">:message</span>') }}
                  </div>

                </div>
                    <br /><br>
                   <div class="row">
                  <div class="col-xs-4"><label>APPROVED ESTIMATES <br>{{$financial_year->year-1}}/{{$financial_year->year}}</label>
                    <input type="text" class="form-control" name="approved_estimate" value="{{$post->approved_estimate}}"  readonly />
                     {{ $errors->first('approved_estimate', '<span class="help-inline" style="color:red">:message</span>') }}
                  </div>
                  <div class="col-xs-4"><label>APPROVED ESTABLISHMENT<br> {{$financial_year->year}}/{{$financial_year->year+1}}</label>
                    <input type="text" class="form-control" name="approved_establishment_next" value="{{$post->approved_establishment_next}}" readonly />
                     {{ $errors->first('approved_establishment_next', '<span class="help-inline" style="color:red">:message</span>') }}
                  </div>
                  <div class="col-xs-4"><label>APPROVED ESTIMATES<br> {{$financial_year->year+1}}/{{$financial_year->year+2}}</label>
                    <input type="text" class="form-control" name="approved_estimate_next" value="{{$post->approved_estimate_next}}"  readonly />
                     {{ $errors->first('approved_estimate_next', '<span class="help-inline" style="color:red">:message</span>') }}
                  </div>

                </div>
                    <br /><br>
                   <div class="row">
                  <div class="col-xs-2"><label>OVER/UNDER</label>
                    <input type="text" class="form-control" name="over_under"   placeholder="eg.-1 " />
                     {{ $errors->first('over_under', '<span class="help-inline" style="color:red">:message</span>') }}
                  </div>
                  <div class="col-xs-4"><label>Select Remark</label>
                  <select class="form-control" name="remark" >
                  @foreach(RefRemark::all() as $item)
                  <option value="{{$item->name}}">{{$item->name}}</option>
                  @endforeach
                  </select>
                  </div>
                  <div class="col-xs-2"><label>No</label>
                    <input type="text" class="form-control" name="remark_no"  placeholder="eg. 10" />
                     {{ $errors->first('remark_no', '<span class="help-inline" style="color:red">:message</span>') }}
                  </div>
                <div class="col-lg-4">
                <div class="box-footer"><br>
                                                    <button type="submit" class="btn btn-info">Update</button>
                                                  </div>
                </div>
                </div>

                </div>
                </div>
                </div><hr/>

 </form>
 </div>
</div>
</div>
</div>
</div>
 @stop