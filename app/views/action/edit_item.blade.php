@extends('action.layouts.default')

@section('content')
<div class="page-content">
<div id="tab-general">
<div class="row mbl">
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-green">

   <div class="col-lg-12">
      <div class="note note-success">
      <small><a style="color: #000000" href="{{URL::to('list_target')}}" title="Click to go back to Objective list">OBJECTIVE  {{$objective->ob_code}} : {{$objective->ob_description}}</a></small> <br>
         <small><a style="color: #000000" href="{{URL::to('list_target')}}" title="Click to go back to Target list">TARGET  {{$target->target_no}} : {{$target->ta_description}}</a></small>
          <br>
       <small><a style="color: #000000" href="{{URL::to('add_activity/'.$activity->target_id )}}" title="Click to go back to Activity list" > ACTIVITY {{$activity->activity_no}} : {{$activity->a_description}}</a></small><br>
          </div>
</div>
            <div class="panel-body pan">
                <form action="{{URL::to('updateItem/'.$data->id)}}" method="post">
                <div class="form-body pal">
                 <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                 <input type="hidden" value="{{$activity->id}}" name="activity_id" />
<div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                     <label for="inputName" class="control-label">
                                             <b>Input</b> </label>
                        <div class="input-icon right">
                           <select name="input_description" class="form-control select2" id="input_description">
                           <option value="{{$data->input_description}}" selected="selected">{{$data->input_description}}</option>
                          @foreach(GfsCode::all() as $item)
                          <option value="{{$item->item_description}}"  id="{{$item->code}}">{{$item->item_description}}</option>

                          @endforeach
                           </select>
                            </div>
                    </div>
                    {{ $errors->first('input_description', '<span class="help-inline" style="color:red">:message</span>') }}
                </div>
                  <div class="col-md-2">
                <div class="form-group">
                 <label for="inputName" class="control-label">
                     <b>Item Code</b> </label>
                    <div class="input-icon right">

                        <input type="text" name="item_code" value="{{$data->item_code}}" class="form-control" id="item_code" readonly="true" />


                    <script>

                     $('#input_description').change(function() {
                                var code = $(this).children(":selected").attr("id");
                                 $('#item_code').val(code)
                                      });
                    </script>


                        </div>
                </div>
                {{ $errors->first('item_code', '<span class="help-inline" style="color:red">:message</span>') }}
            </div>
                <div class="col-md-2">
                    <div class="form-group">
                     <label for="inputName" class="control-label">
                                             <b>Unit of Measure</b> </label>
                        <div class="input-icon right">
                            <select name="unit_of_measure" class="form-control">
                          <option value="{{$data->unit_of_measure}}" selected>{{$data->unit_of_measure}}</option>
                          <option value="person">person</option>
                          <option value="number">number</option>
                          <option value="various">various</option>
                          <option value="sets">sets</option>
                          <option value="litre">litre</option>
                          <option value="units">units</option>
                          <option value="days">days</option>
                          <option value="monthly">monthly</option>
                          </select>
                            </div>
                    </div>
                    {{ $errors->first('unit_of_measure', '<span class="help-inline" style="color:red">:message</span>') }}
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                     <label for="inputName" class="control-label">
                                             <b>Unit Cost</b> </label>
                        <div class="input-icon right">
                            <input type="text" class="form-control" value="{{$data->unit_cost}}" name="unit_cost" />
                            </div>
                    </div>
                    {{ $errors->first('unit_cost', '<span class="help-inline" style="color:red">:message</span>') }}
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                     <label for="inputName" class="control-label">
                                             <b>No Unit</b> </label>
                        <div class="input-icon right">
                            <input type="text" class="form-control" name="no_of_unit" value="{{$data->no_of_unit}}" />
                            </div>
                    </div>
                    {{ $errors->first('no_of_unit', '<span class="help-inline" style="color:red">:message</span>') }}
                </div> 


				<div class="col-md-2">
                    <div class="form-group">
                     <label for="inputName" class="control-label">
                                             <b>No of Input</b> </label>
                        <div class="input-icon right">
                            <input type="text" class="form-control" name="number_of_input" value="{{$data->number_of_input}}" />
                            </div>
                    </div>
                    {{ $errors->first('number_of_input', '<span class="help-inline" style="color:red">:message</span>') }}
                </div>
				

            <div class="col-md-12">
              <div class="pull-right">
                      <input  type="submit"  class="btn btn-primary" value="Update Item" /></div>
            </div>
                                                </div>
                                                </div>
                                                </form>
                                                <hr />
<div class="panel-body">
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Item Code</th>
            <th>Input</th>
            <th>Unit Measure</th>
            <th>Unit Cost</th>
            <th>No of Unit</th>
            <th>Cost (TZS)</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
        <tr>
            <td>{{$item->item_code}}</td>
            <td>{{$item->input_description}}</td>
            <td>{{$item->unit_of_measure}}</td>
            <td>{{$item->unit_cost}}</td>
            <td>{{$item->total_unit}}</td>
            <td>{{$item->cost}}</td>
            </tr>

            @endforeach
            <tr>
                        <th>Total Item Cost (TZS)</th>
                        <td>{{$activity->a_budget}}</td>
                        </tr>
                        <tr>

                    </tr>
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
               @section('scripts')
   <script>

                     $('#input_description').change(function() {
                                var code = $(this).children(":selected").attr("id");
                                 $('#item_code').val(code)
                                      });
                    </script>
@stop