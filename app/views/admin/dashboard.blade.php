@extends('admin/layouts/default')

{{-- Content --}}
@section('content')
              <div class="row">
                  <div class="col-lg-9 main-chart">
                      <div class="row mt">

                    </div><!-- /row -->
					
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->                  
                  
                  <div class="col-lg-3 ds">
                    <!--COMPLETED ACTIONS DONUTS CHART-->
						<h3>NOTIFICATIONS</h3>
                        @foreach($assigned_files as $assigned_file)
                      <div class="desc">
                      	<div class="thumb">
                      		<span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                      	</div>
                      	<div class="details">
                      		<p><muted>{{String::date($assigned_file->created_at)}}</muted>
                      		      &nbsp; <b style="color: #008000">{{$assigned_file->officer}}</b><br/>
                      		   </p>
                      		   <p><a href="{{Url('incoming/details/'. $assigned_file->id)}}"> {{$assigned_file->subject}}</a> <br/>
                      		</p>
                      	</div>
                      </div>
                      @endforeach
                  </div><!-- /col-lg-3 -->
              </div><! --/row -->



@stop