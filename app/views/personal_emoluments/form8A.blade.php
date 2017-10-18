@extends('action.layouts.default')

@section('content')
 <!--BEGIN CONTENT-->

                <div class="page-content">
                    <div id="tab-general">
                        <div id="sum_box" class="row mbl">

                             <div class="col-sm-12 col-md-12">

                             <fieldset><legend> <b></b></legend>
                                 <form  method="POST" action="{{URL::to('personal_emoluments/form8A')}}">
                                  <input type="hidden" name="_token" value="{{{ Session::getToken() }}}"/>

                                     <div class="row">
                                         <div class="col-xs-4 col-sm-4 col-md-4">

                                                 <div class="form-group">

                                                   <select name="year" class="form-control">
                                                   <option value=""> Select Financial Year</option>
                                                    @foreach($years as $year )
                                                    <option value="{{$year->year}}">{{$year->year}}/{{$year->year+1}}</option>
                                                    @endforeach
                                                   </select>

                                                 </div>
                                              </div>
                                                 <div class="col-xs-2 col-sm-2 col-md-2">
                                                   <div class="form-group">
                                                    <input type="submit" class="btn btn-primary" value="Search"/>
                                                    </div>
                                                 </div>
                                     </div>
                                     </form>
                                     </fieldset>

                             @if( isset($items) && count($items) > 0)
                            <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>CODE NO</th>
                                <th>DESIGNATION</th>
                                <th>SALARY SCALE</th>
                                <th>ESTABLISHED MANNING LEVEL {{$financialYear}}/{{$financialYear+1}}</th>
                                <th>ACTUAL STRENGTH {{$financialYear-1}}/{{$financialYear}}</th>
                                <th>APPROVED ESTAB {{$financialYear-1}}/{{$financialYear}}</th>
                                <th>APPROVED ESTIMATES {{$financialYear-1}}/{{$financialYear}}</th>
                                <th>APPROVED ESTAB {{$financialYear}}/{{$financialYear+1}}</th>
                                <th>APPROVED ESTIMATES {{$financialYear+1}}/{{$financialYear+2}}</th>

                            </tr>

                            </thead>
                            <tbody>
                            @foreach($items as $item)
                             <tr>
                            <td>{{$item->code_no}}</td>
                            <td>{{$item->designation}}</td>
                            <td>{{$item->salary_scale}}</td>
                            <td>{{$item->established_meaning_level}}</td>
                            <td>{{$item->actual_strength}}</td>
                            <td>{{String::formatMoney($item->approved_establishment)}}</td>
                            <td>{{String::formatMoney($item->approved_estimate)}}</td>
                            <td>{{String::formatMoney($item->approved_establishment_next)}}</td>
                            <td>{{String::formatMoney($item->approved_estimate_next)}}</td>
                            </tr>
                            @endforeach
                            <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{$establishedMeaningLevelSum}}</td>
                            <td>{{$actualStrengthSum}}</td>
                            <td>{{$approvedEstablishmentSum}}</td>
                            <td>{{String::formatMoney($approvedEstimateSum)}}</td>
                            <td>{{String::formatMoney($approvedEstablishmentNextSum)}}</td>
                            <td>{{String::formatMoney($approvedEstimateNextSum)}}</td>
                            <td></td>
                            </tr>
                            </tbody>
                            </table>

                             <div class="row no-print">
                                <div class="col-xs-12">
                                  <a href="{{URL::to('personal_emoluments/downloadForm8A/'.$financialYear)}}" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Generate Excel</a>
                                </div>
                              </div>

                            @else
                            <div class=" form-control alert-warning">No data for the selected year</div>
                             @endif

                             </div>
                          </div>
                       </div>
                    </div>

                    @stop
