<!DOCTYPE html>
<html lang="en">
<head>
    <title>TFS | Action Plan</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Loading bootstrap css-->
    <link type="text/css" rel="stylesheet" href="{{asset('action_plan/styles/font-awesome.min.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('action_plan/styles/bootstrap.min.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('action_plan/styles/main.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('action_plan/styles/style-responsive.css')}}">
</head>
<body class="skin-blue fixed sidebar-mini">
 <div id="wrapper">
        <!--BEGIN TOPBAR-->
        <div id="header-topbar-option-demo" class="page-header-topbar">
            <nav id="topbar" role="navigation" style="margin-bottom: 0;" data-step="3" class="navbar navbar-default navbar-static-top">
            <div class="navbar-header"><input type="hidden" value="{{$zone = Zone::where('id', '=', Auth::user()->zone_id)->first()}}" />
                <button type="button" data-toggle="collapse" data-target=".sidebar-collapse" class="navbar-toggle"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                <a id="logo" href="#" class="navbar-brand"><span class="fa fa-rocket"></span><span class="logo-text">{{$zone->zone_name}}</span><span style="display: none" class="logo-text-icon">µ</span></a></div>
            <div class="topbar-main"><a id="menu-toggle" href="#" class="hidden-xs"><i class="fa fa-bars"></i></a>

                <ul class="nav navbar navbar-top-links navbar-right mbn">
                    <li class="dropdown topbar-user"><a data-hover="dropdown" href="#" class="dropdown-toggle"><img src="{{asset('action_plan/images/avatar/48.jpg')}}" alt="" class="img-responsive img-circle"/>&nbsp;<span class="hidden-xs">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</span>&nbsp;<span class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-user pull-right">
                         @if (Auth::user())
                            <li><a href="{{URL::to('user/logout')}}"><i class="fa fa-key"></i>Log Out</a></li>
                                @else

                                     <li {{ (Request::is('user/login') ? ' class="active"' : '') }}><a href="{{{ URL::to('user/login') }}}">Login</a></li>
                                      @endif
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        </div>

            <nav id="sidebar" role="navigation" data-step="2" data-intro="Template has &lt;b&gt;many navigation styles&lt;/b&gt;"
                data-position="right" class="navbar-default navbar-static-side">
            <div class="sidebar-collapse menu-scroll">
                <ul id="side-menu" class="nav">
                     <div class="clearfix"></div>
                    <li><a href="{{URL::to('myDashboard')}}"><i class="fa fa-tachometer fa-fw">
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
                    <li><a href="{{URL::to('mybudget/index')}}"><i class="fa fa-envelope-o">
                        <div class="icon-bg bg-primary"></div>
                    </i><span class="menu-title">My Budget</span></a>
                    </li>
                </ul>
            </div>
        </nav>

            <div id="page-wrapper">
<section class="content-header">
               @include('notifications')
        	   </section>

                    @yield('content')

                <div id="footer">
                    <div class="copyright">
                        <a href="#">2016 © TFS</a></div>
                </div>

            </div>
        </div>

    <script src="{{asset('action_plan/script/jquery-1.10.2.min.js')}}"></script>
    <script src="{{asset('action_plan/script/jquery-migrate-1.2.1.min.js')}}"></script>
    <script src="{{asset('action_plan/script/jquery-ui.js')}}"></script>
    <script src="{{asset('action_plan/script/bootstrap.min.js')}}"></script>
    <script src="{{asset('action_plan/script/respond.min.js')}}"></script>
    <script src="{{asset('action_plan/script/jquery.metisMenu.js')}}"></script>
    <script src="{{asset('action_plan/script/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('action_plan/script/custom.min.js')}}"></script>
    <script src="{{asset('action_plan/script/jquery.menu.js')}}"></script>
    <script src="{{asset('action_plan/script/responsive-tabs.js')}}"></script>
</body>
</html>
