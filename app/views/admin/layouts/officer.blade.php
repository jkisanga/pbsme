<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>TFS eFILE - Users</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="{{asset('assets/css/ionicons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{asset('assets/css/AdminLTE.css')}}" rel="stylesheet" >
    <link href="{{asset('assets/css/blue.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/css/_all-skins.css')}}" rel="stylesheet" >
    <link href="{{asset('assets/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}" rel="stylesheet" type="text/css">
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
        <!-- Header Navbar: style can be found in header.less -->
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
                                    <div class="pull-right">
                                    @if (Auth::user())
                                      <a href="{{URL::to('user/logout')}}" class="btn btn-default btn-flat">Sign out</a>
                                      @else

                                       <li {{ (Request::is('user/login') ? ' class="active"' : '') }}><a href="{{{ URL::to('user/login') }}}">Login</a></li>
                                           @endif
                                    </div>
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
            <li>
              <a href="{{Url('auth/dashboard')}}">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
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
    <script src="../../plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src="../../plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('assetsh/js/dashboard.js')}}" type="text/javascript"></script>
    <script>
          $(function () {
            //Add text editor
            $("#compose-textarea").wysihtml5();
          });
        </script>
  </body>
</html>
