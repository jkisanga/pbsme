@extends('admin/layouts/default')

{{-- Content --}}
@section('content')
<section class="content">
               <div class="row">
                         <div class="col-md-3 col-sm-6 col-xs-12">
                           <div class="info-box"><a href="{{URL::to('files/in_registry')}}">
                             <span class="info-box-icon bg-aqua"><i class="fa fa-folder-open-o"></i></span></a>
                             <div class="info-box-content">
                               <span class="info-box-text">Files in Registry</span>
                               <span class="info-box-number">{{$file_in_registry->count()}}</span>
                             </div><!-- /.info-box-content -->
                           </div><!-- /.info-box -->
                         </div><!-- /.col -->
                         <div class="col-md-3 col-sm-6 col-xs-12">
                           <div class="info-box"><a href="{{URL::to('files/on_move')}}">
                             <span class="info-box-icon bg-blue-gradient"><i class="fa fa-mail-forward"></i></span></a>
                             <div class="info-box-content">
                               <span class="info-box-text">File in Move</span>
                               <span class="info-box-number">{{$files_on_move->count()}}</span>
                             </div><!-- /.info-box-content -->
                           </div><!-- /.info-box -->
                         </div><!-- /.col -->

                         <!-- fix for small devices only -->
                         <div class="col-md-3 col-sm-6 col-xs-12">
                           <div class="info-box"><a href="{{URL::to('files/overdue')}}">
                             <span class="info-box-icon bg-red"><i class="fa fa-folder"></i></span></a>
                             <div class="info-box-content">
                               <span class="info-box-text">Overdue Files</span>
                               <span class="info-box-number">{{$overdue->count()}}</span>
                             </div><!-- /.info-box-content -->
                           </div><!-- /.info-box -->
                         </div><!-- /.col -->
                         <div class="col-md-3 col-sm-6 col-xs-12">
                           <div class="info-box"><a href="{{URL::to('files/booked')}}">
                             <span class="info-box-icon bg-yellow"><i class="fa fa-paper-plane"></i></span></a>
                             <div class="info-box-content">
                               <span class="info-box-text">Booked Files</span>
                               <span class="info-box-number">{{$booked_files->count()}}</span>
                             </div><!-- /.info-box-content -->
                           </div><!-- /.info-box -->
                         </div><!-- /.col -->
                       </div><!-- /.row -->
                       <!-- Main row -->
                                 <div class="row">
                                   <!-- Left col -->
                                   <div class="col-md-8">
                                     <!-- MAP & BOX PANE -->

                                     <div class="row">
                                       <div class="col-md-6">
                                         <!-- DIRECT CHAT -->

                                         <!-- USERS LIST -->
                     <div class="box box-success">
                       <div class="box-header with-border">
                         <h3 class="box-title">Recently Incoming Mails</h3>
                         <div class="box-tools pull-right">
                           <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                           <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                         </div>
                       </div><!-- /.box-header -->
                      <div class="box-body no-padding">
                        <table class="table table-striped">
                        @if($mails->count())
                        @foreach($mails as $mail)
                          <tr>
                            <td><a style="color: #000" href="{{URL::to('incoming/show/'. $mail->id)}}">{{$mail->subject}}</a></td>
                            <td><span class="badge bg-green-active">{{String::date($mail->created_at)}}</span></td>
                          </tr>
                            @endforeach
                            @else
                            There is no Mails
                            @endif
                        </table>
                      </div><!-- /.box-body -->
                       <div class="box-footer text-center">
                         <a href="{{URL::to('incoming/dashboard')}}" class="uppercase">View All</a>
                       </div><!-- /.box-footer -->
                     </div><!--/.box -->

                 <div class="box box-danger">
                   <div class="box-header with-border">
                     <h3 class="box-title">Overdue Files List</h3>
                     <div class="box-tools pull-right">
                       <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                       <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                     </div>
                   </div><!-- /.box-header -->
                    <div class="box-body no-padding">
                   <table class="table table-striped">
                   @if($files_on_move->count())
                     @foreach($overdue as $file)
                       <tr>
                         <td>{{$file->fileModel->name}} ({{$file->fileModel->number}}) </td>
                         <td><span class="badge bg-red">{{String::date($file->created_at)}}</span></td>
                       </tr>
                         @endforeach
                         @else
                         There is no File on Movement
                         @endif
                   </table>
                 </div>
               <div class="box-footer text-center">
                 <a href="{{URL::to('files/overdue')}}" class="uppercase">View All</a>
               </div><!-- /.box-footer -->
             </div><!--/.box -->


                   </div><!-- /.col -->
                       <div class="col-md-6">
                         <!-- USERS LIST -->
                         <div class="box box-info">
                           <div class="box-header with-border">
                             <h3 class="box-title">Recently Outoing Mails</h3>
                             <div class="box-tools pull-right">
                               <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                               <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                             </div>
                           </div><!-- /.box-header -->
                           <div class="box-body no-padding">
                              <table class="table table-striped">
                              @if($outgoing->count())
                              @foreach($outgoing as $mail)
                                <tr>
                                  <td>{{$mail->subject}}</td>
                                  <td><span class="badge bg-green-active">{{String::date($mail->created_at)}}</span></td>
                                </tr>
                                  @endforeach
                                  @else
                                  There is no Mails
                                  @endif
                              </table>
                            </div><!-- /.box-body -->
                           <div class="box-footer text-center">
                             <a href="javascript::" class="uppercase">View All</a>
                           </div><!-- /.box-footer -->
                         </div><!--/.box --> <!-- USERS LIST -->
                         <div class="box box-body">
                           <div class="box-header with-border">
                             <h3 class="box-title">Files on Movement</h3>
                             <div class="box-tools pull-right">
                               <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                               <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                             </div>
                           </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                               <table class="table table-striped">
                               @if($files_on_move->count())
                               @foreach($files_on_move as $file)
                                 <tr>
                                   <td><a href="{{URL::to('files/movement/'. $file->id)}}" style="color: #000" data-toggle="tooltip" title="Click to track Movement">{{$file->name}} ({{$file->number}})</td>
                                 </tr>
                                   @endforeach
                                   @else
                                   There is no File on Movement
                                   @endif
                               </table>
                             </div><!-- /.box-body -->
                                           <div class="box-footer text-center">
                                             <a href="{{URL::to('files/dashboard')}}" class="uppercase">View All </a>
                                           </div><!-- /.box-footer -->
                                         </div><!--/.box -->
                                       </div><!-- /.col -->
                                     </div><!-- /.row -->


                                   </div><!-- /.col -->

                                   <div class="col-md-4">
                                     <!-- Info Boxes Style 2 -->
                                     <div class="info-box bg-yellow"><a href="{{URL::to('incoming/dashboard')}}" class="bg-yellow">
                                       <span class="info-box-icon"><i class="fa fa-envelope-square"></i></span>
                                       <div class="info-box-content">
                                         <span class="info-box-text">Incoming Mails</span>
                                         <span class="info-box-number">{{$mails_less_than_30days->count()}}</span>
                                         <div class="progress">

                                           <div class="progress-bar" style="width: 100% "></div>
                                         </div>
                                         <span class="progress-description">
                                           100%  in 30 Days
                                         </span>
                                       </div><!-- /.info-box-content -->
                                     </a></div><!-- /.info-box -->
                                     <div class="info-box bg-blue-gradient"><a href="{{URL::to('incoming/in_process')}}" class="bg-blue-gradient">
                                       <span class="info-box-icon"><i class="fa fa-envelope-o"></i></span>
                                       <div class="info-box-content">
                                         <span class="info-box-text">In Process</span>
                                         <span class="info-box-number">{{$mails_less_than_30days_attended->count()}}</span>
                                         <div class="progress">
                                           <div class="progress-bar" style="width: {{$mails_attended}}%"></div>
                                         </div>
                                         <span class="progress-description">
                                           {{number_format($mails_attended,1)}}% Increase in 30 Days
                                         </span>
                                       </div><!-- /.info-box-content -->
                                    </a> </div><!-- /.info-box -->

                                     <div class="info-box bg-green"><a href="{{URL::to('incoming/attended')}}" class="bg-green">
                                       <span class="info-box-icon"><i class="fa fa-envelope-o"></i></span>
                                       <div class="info-box-content">
                                         <span class="info-box-text">Attended Mails</span>
                                         <span class="info-box-number">{{$mails_less_than_30days_attended->count()}}</span>
                                         <div class="progress">
                                           <div class="progress-bar" style="width: {{$mails_attended}}%"></div>
                                         </div>
                                         <span class="progress-description">
                                           {{number_format($mails_attended,1)}}% Increase in 30 Days
                                         </span>
                                       </div><!-- /.info-box-content -->
                                    </a> </div><!-- /.info-box -->

                                     <div class="info-box bg-red"><a href="{{URL::to('incoming/not_attended')}}" class="bg-red">
                                       <span class="info-box-icon"><i class="fa fa-envelope"></i></span>
                                       <div class="info-box-content">
                                         <span class="info-box-text">Not Attended Mails</span>
                                         <span class="info-box-number">{{$mails_less_than_30days_not_attended->count()}}</span>
                                         <div class="progress">
                                           <div class="progress-bar" style="width: {{$mails_not_attended}}%"></div>
                                         </div>
                                         <span class="progress-description">
                                           {{number_format($mails_not_attended,1)}}% Increase in 30 Days
                                         </span>
                                       </div><!-- /.info-box-content -->
                                     </a></div><!-- /.info-box -->

                                     </div><!-- /.box -->
                                   </div><!-- /.col -->
                                 </div><!-- /.row -->


@stop