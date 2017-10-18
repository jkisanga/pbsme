@extends('action.layouts.default')

@section('content')
<div class="col-lg-12">
<div class="x_panel">
     <div class="x_title">
           <h2>
       <b>List Of Kpi Fields</b></h2>
		
        <div class="clearfix"></div>
            </div>
          <div class="x_content">

                              <form action="@if(isset($kpiField)){{{ URL::to('refKpiFields/update',$kpiField->id) }}}@else{{URL::to('refKpiFields/store')}}@endif" method="post">
                              <div class="form-body pal">
                                  <div class="row">
                                     <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                      <div class="col-md-2">
                                          <div class="form-group">
                                          <label>Field Name</label>
                                              <div class="input-icon">
                                                <input  type="text"  name="name" class="form-control" required="true" value="{{{ Input::old('name', isset($kpiField) ? $kpiField->name : null) }}}" /></div>
                                              </div>
                                          </div>

                                       <div class="col-md-4">
                                          <div class="form-group">
                                          <label>Field Label</label>
                                              <div class="input-icon">
                                                  <input  type="text"  name="label" class="form-control" required="true"  value="{{{ Input::old('label', isset($kpiField) ? $kpiField->label : null) }}}" /></div>
                                          </div>
                                      </div>
                                        <div class="col-md-2">
                                          <div class="form-group">
                                          <label>Data Type </label>
                                              <div class="input-icon">
                                                <select name="data_type" id="data_type" class="form-control" required="true">
													@if(isset($kpiField))
													 <option value="{{$kpiField->data_type}}">{{$kpiField->data_type}}</option>
													@endif
                                                   <option value="string">string</option>
                                                   <option value="date">date</option>
                                                   <option value="datetime">datetime</option>
                                                   <option value="enum">enum[dropdown]</option>
                                                   <option value="binary">binary</option>
                                                   <option value="integer">integer</option>
                                                   <option value="boolean">boolean</option>
                                                   <option value="decimal">decimal</option>
                                                   <option value="double">double</option>
                                                   <option value="float">float</option>
                                                 </select>
                                            </div>
                                          </div>
                                      </div>

                                      <div class="col-md-4">
                                         <div class="form-group">
                                         <label>Validation Rule</label>
                                             <div class="input-icon">
                                                 <input  type="text"  name="validation_rule" class="form-control"  value="{{{ Input::old('validation_rule', isset($kpiField) ? $kpiField->validation_rule : null) }}}" /></div>
                                         </div>
                                     </div>

                                  </div>
								   <div class="row fields">
								    <div class="col-md-6" id="enum">
									@if(isset($kpiField) && $kpiField->data_type=="enum")
										<label>Drop Down Options eg. Low,High </label>
											<input type="text" name="options" class="form-control" value="{{{ Input::old('options', isset($kpiField) ? $kpiField->options : null) }}}" />
									@endif
                                        
								   </div>
                                  <div class="row">
                                   <div class="col-md-12">
                                  <div class="form-group pull-right">
											@if(isset($kpiField))
													   <button  type="submit"  class="btn btn-warning btn-sm"  ><i class="fa fa-save"></i> Update</button>
												  
													  <a href="{{URL::to('refKpiFields/create')}}" class="btn btn-sm btn-warning pull-right"><i class="fa fa-backward"></i></a>
											@else
                                          <button  type="submit"  class="btn btn-primary btn-sm"  ><i class="fa fa-save"></i> Save</button>
									  @endif
                                          </div>
                              </div>
                                  </div>
                                  <hr />
                              </div>
                              </form>

                              <table class="table table-hover table-bordered dt jambo_table bulk_action " >
                                  <thead>
                                  <tr>
                       <th> Name</th>
                       <th >Label</th>
                       <th>Data type</th>
                       <th>Action</th>
                   </tr>
                   </thead>
                   <tbody>
                   @foreach($fields as $field)

                  <tr >
                  <td cass="active">{{$field->name}}</td>
                  <td class="warning">{{$field->label}}</td>
                  <td class="active">{{$field->data_type}}</td>
                  <td><a href="<?php echo URL::to('refKpiFields/delete',$field->id)?>" class="btn  btn-sm btn-danger" onclick="return confirm('are you sure?')"> Remove</a>
				  <a href="<?php echo URL::to('refKpiFields/edit',$field->id)?>" class="btn  btn-sm btn-warning"> Edit</a>
				  </td>
                  </tr>
                   @endforeach

                     </tbody>
              </table>
                          </div>
                      </div>
                  </div>

                    </div>
                <!--END CONTENT-->
                </section>

@section('scripts')
    <script type="text/javascript">
        $( document ).ready(function() {
			
		function removeRow() {
			 var elem = document.getElementById('enumid');
			elem.parentNode.removeChild(elem);
			return false;
		}
		
		function addNew() {
			addRow();
		}
		
		function addRow() {
			var div = document.createElement('div');

			div.className = 'form-group';
			
			div.id = 'enumid';

			div.innerHTML = ' <label>Drop Down Options eg. Low,High </label>\ <input type="text" name="options" class="form-control" value="" />';

			 document.getElementById('enum').appendChild(div);
		}
			
			   $('#data_type').change(function () {
					 var ddl = document.getElementById("data_type");
					 var selectedValue = ddl.options[ddl.selectedIndex].value;
					if (selectedValue == "enum")
					   {
						addRow();
					   }else{
						removeRow();
					   }
			   });
		

        });
    </script>
@endsection
               @stop
