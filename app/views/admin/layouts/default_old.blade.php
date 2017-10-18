<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta charset="UTF-8">
    <title>TFS | eFILE</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->

    <link href="{{asset('assets/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="{{asset('assets/css/ionicons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{asset('assets/css/AdminLTE.css')}}" rel="stylesheet" >
    <link href="{{asset('assets/css/blue.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/_all-skins.css')}}" rel="stylesheet" >
    <link href="{{asset('assets/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('assets/datatables/dataTables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
  <link href="{{asset('assets/datetimepicker/jquery.datetimepicker.css')}}" rel="stylesheet" type="text/css" />
  </head>
  <body class="skin-blue fixed sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="#" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>TFS</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>TFS</b> eFILE System</span>
        </a>
        <nav class="navbar navbar-static-top" role="navigation">
                  <!-- Sidebar toggle button-->
                  <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                  </a>
                  <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                      <!-- User Account: style can be found in dropdown.less -->
                      <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                          <h4><span class="hidden-xs">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</span> <i class="fa fa-arrow-down"></i></h4>
                        </a>
                        <ul class="dropdown-menu">
                          <!-- User image -->
                          <li class="user-header">
                            <img src="{{asset('assets/img/tfs.png')}}" class="img-circle" alt="User Image" />
                          </li>

                          <li class="user-footer">
                            <div class="pull-left">
                              <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                          <!--  <div class="pull-right">
                            @if (Auth::user())
                              <a href="{{URL::to('user/logout')}}" class="btn btn-default btn-flat">Sign out</a>
                              @else

                               <li {{ (Request::is('user/login') ? ' class="active"' : '') }}><a href="{{{ URL::to('user/login') }}}">Login</a></li>
                                   @endif
                            </div> -->
                          </li>
                        </ul>
                      </li>
                    </ul>
                  </div>
                </nav>
      </header>

      <!-- =============================================== -->

      <!-- Left side column. contains the sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
       <!--      <li>
              <a href="{{Url('home/index')}}">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>
            
           <li><a href="{{Url('incoming/dashboard')}}"><i class="fa fa-share"></i> <span>Incoming Mails Manager</span></a></li>
            <li><a href="{{Url('outgoing')}}"><i class="fa fa-reply"></i> <span>Outgoing Mails Manager</span></a></li>
            <li><a href="{{Url('files')}}"><i class="fa fa-folder-o"></i> <span>File Manager</span></a></li>
             <li><a href="{{Url('reports')}}"><i class="fa fa-folder-open-o"></i> <span>Report Manager</span></a></li>
			 -->
			 <li><a href="{{URL::to('dashboard')}}"><i class="fa fa-tachometer fa-fw">
                                     <div class="icon-bg bg-orange"></div>
                                 </i><span class="menu-title">Dashboard</span></a></li>

                                 <li><a href="{{URL::to('list_objective')}}"><i class="fa fa-desktop fa-fw">
                                     <div class="icon-bg bg-pink"></div>
                                 </i><span class="menu-title">Objectives</span></a>

                                 </li>
                                 <li><a href="{{URL::to('select_objective')}}"><i class="fa fa-send-o fa-fw">
                                     <div class="icon-bg bg-green"></div>
                                 </i><span class="menu-title">Target</span></a>

                                 </li>

                                 <li><a href="{{URL::to('list_target')}}"><i class="fa fa-sitemap fa-fw">
                                     <div class="icon-bg bg-dark"></div>
                                 </i><span class="menu-title">Activities</span></a>
                                 </li>
                                 <li><a href="{{URL::to('full_budget')}}"><i class="fa fa-envelope-o">
                                     <div class="icon-bg bg-primary"></div>
                                 </i><span class="menu-title">My Budget</span></a>
                                 </li>
                                  <li><a href="{{URL::to('zones/index')}}"><i class="fa fa-envelope-o">
                                      <div class="icon-bg bg-primary"></div>
                                  </i><span class="menu-title">Zones</span></a>
                                  </li>
                                  <li><a href="{{URL::to('admin/users')}}"><i class="fa fa-user">
                                      <div class="icon-bg bg-primary"></div>
                                  </i><span class="menu-title">User Manager</span></a>
                                  </li>
			   @if (Auth::user())
                <li ><a href="{{URL::to('user/logout')}}"> <i class="glyphicon glyphicon-off"></i>Logout</a></li>
				@endif
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
		 <section class="content-header">
       @include('notifications')
	   </section>
        <!-- Main content -->
		@yield('content')
        <!-- /.content -->
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0
        </div>
        <strong>Copyright &copy; 2014-2015 <a href="#">TFS</a>.</strong> All rights reserved.
      </footer>

      
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="{{asset('assets/jquery/jQuery-2.1.4.min.js')}}" text="text/javascript"></script>
    <script src="{{asset('assets/jquery/app.min.js')}}" text="text/javascript"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{asset('assets/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/js/iCheck.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js')}}" type="text/javascript"></script>
    <!-- SlimScroll -->
        <script src="{{asset('assets/datatables/jquery.dataTables.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/datatables/dataTables.bootstrap.min.js')}}" type="text/javascript"></script>

    <script src="{{asset('assets/js/select2.full.min.js')}}" type="text/javascript"></script>
        <!-- InputMask -->
        <script src="{{asset('assets/js/jquery.inputmask.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/js/jquery.inputmask.date.extensions.js')}}" type="text/javascript"></script>
		<script src="{{asset('assets/datetimepicker/jquery.datetimepicker.js')}}" type="text/javascript"></script>
    <!-- FastClick -->
    <script>

     $('.datetimepicker').datetimepicker({

        });

          $(function () {
            //Add text editor
            $("#compose-textarea").wysihtml5();

            //Initialize Select2 Elements
                    $(".select2").select2();

                    //Datemask dd/mm/yyyy
                    $("#datemask").inputmask("yyyy/mm/dd", {"placeholder": "yyyy/mm/dd"});
                    //Datemask2 mm/dd/yyyy
                    $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
                      $("[data-mask]").inputmask();
          });
        </script>
        <script type="text/javascript">
              $(function () {
                $(".table").DataTable();
                $('#example2').DataTable({
                  "paging": true,
                  "lengthChange": false,
                  "searching": false,
                  "ordering": true,
                  "info": true,
                  "autoWidth": false
                });
              });
            </script>
  </body>
</html>
