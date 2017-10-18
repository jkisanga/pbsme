@extends('action.layouts.default')

@section('content')
 <div class="col-md-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title" style="background-color: #faf2cc">
    <p><a style="color: #000000" href="{{URL::to('list_target')}}" title="Click to go back to Objective list">OBJECTIVE  {{$objective->ob_code}} : {{$objective->ob_description}}</a>
    <a href="{{URL::to('add_activity/'.$activity->target_id )}}" class="btn btn-sm btn-default pull-right" title="Back"><i class="fa fa-home"></i></a>
    </p>
         <p><a style="color: #000000" href="{{URL::to('list_target')}}" title="Click to go back to Target list">TARGET  {{$target->target_no}} : {{$target->ta_description}}</a></p>
       <small><a style="color: #000000" href="{{URL::to('add_activity/'.$activity->target_id )}}" title="Click to go back to Activity list" > ACTIVITY {{$activity->activity_no}} : {{$activity->a_description}}</a></small><br>
       <div class="clearfix"></div>
               </div>
                         <div class="x_content">

<br>

                <form action="{{URL::to('store_item')}}" method="post">
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
                           <option disabled selected>Select Input</option>
                          @foreach(GfsCode::orderBy('item_description')->get() as $item)
                          <option value="{{$item->item_description}}" id="{{$item->code}}">{{$item->item_description}} [ {{$item->code}} ]</option>

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

                        <input type="text" name="item_code" class="form-control" id="item_code" readonly="true" />


                 


                        </div>
                </div>
                {{ $errors->first('item_code', '<span class="help-inline" style="color:red">:message</span>') }}
            </div>
                <div class="col-md-2">
                    <div class="form-group">
                     <label for="inputName" class="control-label">
                                             <b>Unit of Measure</b> </label>
                          <div class="form-group {{{ $errors->has('unit_of_measure') ? 'has-error' : '' }}}">
                                   <select name="unit_of_measure" class="form-control">

                                  <option  value="{{{Input::old('unit_of_measure', isset($unit_measure) ? $unit_measure->description : null)}}}">{{{Input::old('unit_of_measure', isset($unit_measure) ? $unit_measure->description : null)}}}</option>
                                         @foreach($unit_measures as $unit_measure)
                                            <option value="{{$unit_measure->description}}">{{$unit_measure->description}}</option>
                                          @endforeach
                                  </select>
                                         {{ $errors->first('unit_of_measure', '<span class="help-block">:message</span>') }}
                                 </div>

                    </div>
                    {{ $errors->first('unit_of_measure', '<span class="help-inline" style="color:red">:message</span>') }}
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                     <label for="inputName" class="control-label">
                                             <b>Unit Cost</b> </label>
                        <div class="input-icon right">
                            <input type="text" class="form-control" name="unit_cost" />
                            </div>
                    </div>
                    {{ $errors->first('unit_cost', '<span class="help-inline" style="color:red">:message</span>') }}
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                     <label for="inputName" class="control-label">
                           <b>No Unit</b> </label>
                        <div class="input-icon right">
                            <input type="text" class="form-control" name="no_of_unit" />
                            </div>
                    </div>
                    {{ $errors->first('no_of_unit', '<span class="help-inline" style="color:red">:message</span>') }}
                </div>


				<div class="col-md-2">
                    <div class="form-group">
                     <label for="inputName" class="control-label">
                                             <b>No of Input</b> </label>
                        <div class="input-icon right">
                            <input type="text" class="form-control" name="number_of_input" />
                            </div>
                    </div>
                    {{ $errors->first('number_of_input', '<span class="help-inline" style="color:red">:message</span>') }}
                </div>

            <div class="col-md-12">
			
              <div class="pull-right">
                      <input  type="submit"  class="btn btn-primary" value="Add Item" /></div>
            </div>
                                                </div>
                                                </div>

                                                </form>
                                                <hr />
    <table class=" dt table table-hover">
        <thead>
        <tr>
            <th >Item Code</th>
            <th >Input</th>
            <th  >Unit Measure</th>
            <th  >Unit Cost</th>
            <th  >No of Unit</th>
            <th  >Cost (TZS)</th>
            <th class="col-lg-1" >Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
        <tr>
            <td>{{$item->item_code}}</td>
            <td>{{$item->input_description}}</td>
            <td>{{$item->unit_of_measure}}</td>
            <td>{{String::formatMoney($item->unit_cost)}}</td>
            <td>{{$item->total_unit}}</td>
            <td>{{String::formatMoney($item->cost)}}</td>
            <td class="col-lg-1">
            <a class="btn btn-primary btn-xs" href="{{URL::to('edit_item/'.$item->id)}}" title="Edit"> <i class="fa fa-pencil"></i> </a>
            <a class="btn btn-danger btn-xs" href="{{URL::to('delete_item/'.$item->id)}}" title="Remove" onclick="return confirm('are you sure?');"> <i class="fa fa-trash-o"></i> </a>
            </td>
         </tr>

            @endforeach
            
            <tr>
                        <td>Total Item Cost (TZS)</td>
                        <td><b>{{String::formatMoney($total)}}</b></td>
						<td><td>
						<td><td>
						<td><td>
						<td><td>
						<td><td>
                        </tr>           
</tbody>
</table>


	@if(count($items) > 0)
		<div class="pull-right">
				<a class="btn btn-success" href="{{URL::to('add_activity/'.$activity->target_id )}}" > <i class="fa fa-save"></i> Save Activity</a>
			</div>
	@endif
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