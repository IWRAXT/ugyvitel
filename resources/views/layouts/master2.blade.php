<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AnonymusÜgyvitel</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>

    {{--<link rel="stylesheet" href="/node_modules/admin-lte/dist/css/AdminLTE.min.css">--}}


</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-black layout-mini">
<div class="wrapper" id="app">


    <!-- Main Header -->

    <header class="main-header">

        <!-- Logo -->
        <a href="/home" class="logo" style="padding-bottom: 60px">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><img src="/images/icon.png" style="width:50px;height:50px;border:0;"></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><img src="/images/icon.png" style="width:60px;height:60px;border:0;"> Ügyvitel</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar nnavbar-expand-lg" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">


                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <img src="/storage/images/{{ Auth::user()->employee->image }}" class="user-image"
                                 alt="User Image">
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="/storage/images/{{ Auth::user()->employee->image }}" class="img-circle"
                                     alt="User Image">

                                <p>
                                    {{ Auth::user()->name }}
                                </p>
                            </li>

                            <!-- Menu Footer-->
                            <li class="user-footer">

                                <div class="pull-right">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </nav>
    </header>

    <!-- Left side column. contains the logo and sidebar -->


    <aside class="main-sidebar" style="padding-top: 60px">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">


            <!-- search form (Optional) -->
        {{--<form action="#" method="get" class="sidebar-form">--}}
        {{--<div class="input-group">--}}
        {{--<input type="text" name="q" class="form-control" placeholder="Search...">--}}
        {{--<span class="input-group-btn">--}}
        {{--<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>--}}
        {{--</button>--}}
        {{--</span>--}}
        {{--</div>--}}
        {{--</form>--}}
        <!-- /.search form -->

            <!-- Sidebar Menu -->
            {{--ADMIN--}}
            @can('isAdmin')
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header"><b>ADMINISZTRÁTOR MÓD</b></li>
                    <!-- Optionally, you can add icons to the links -->


                    <li class="treeview">
                        <a href="#"><i class="fa fa-users"></i> <span>Munkatársak</span>
                            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>

                         </span>
                        </a>
                        <ul class="treeview-menu">

                            <li><a href="/people/index">Listázás</a></li>
                            <li><a href="/people/create">Új munkatárs rögzítése</a></li>
                            <li><a href="/users/index"><i class="fa fa-user-o"></i>Jogosultság kezelés</a></li>
                        </ul>
                    </li>

                    <li class="treeview">
                        <a href="#"><i class="fa fa-plus"></i> <span>Bevételek</span>
                            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>

                         </span>
                        </a>
                        <ul class="treeview-menu">

                            <li><a href="/incomes/index">Listázás</a></li>
                            <li><a href="/incomes/create">Új bevétel rögzítése</a></li>
                            <li><a href="/incomes/create">Új bevétel típus rögzítése</a></li>
                            <li><a href="/incomes/report"><i class="fa fa-table"></i>Összesítők</a></li>

                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-handshake-o"></i> <span>Ügyfelek</span>
                            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                         </span>
                        </a>
                        <ul class="treeview-menu">

                            <li><a href="/costs/index">Listázás</a></li>
                            <li><a href="/costs/create">Új ügyfél rögzítése</a></li>
                        </ul>
                    </li>

                    <li class="treeview">
                        <a href="#"><i class="fa fa-minus"></i> <span>Kiadások</span>
                            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>

                         </span>
                        </a>
                        <ul class="treeview-menu">

                            <li><a href="/costs/index">Listázás</a></li>
                            <li><a href="/costs/create">Új kiadás rögzítése</a></li>
                            <li><a href="/cost_types/create">Új kiadás típus rögzítése</a></li>
                            <li><a href="/costs/report"><i class="fa fa-table "></i>Összesítők</a></li>

                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-truck"></i> <span>Beszállítók</span>
                            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>

                         </span>
                        </a>
                        <ul class="treeview-menu">

                            <li><a href="/suppliers/index">Listázás</a></li>
                            <li><a href="/suppliers/create">Új beszállító rögzítése</a></li>

                        </ul>
                    </li>

                    <li class="treeview">
                        <a href="#"><i class="fa fa-bank"></i> <span>Telephely</span>
                            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>

                         </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="/mysite"><i class="fa fa-bank"></i>{{Auth::user()->employee->site->name}}</a></li>
                            <li><a href="/sites/report"><i class="fa fa-table "></i>Telephelyi összesítő</a></li>
                            @can('isSites')
                                <li><a href="/sites/index">Összes telephely</a></li>
                                <li><a href="/sites/create">Új telephely felvétele</a></li>


                        </ul>
                    </li>

                    <li><a href="/sites/statistic"><i class="fa fa-pie-chart"></i> <span>Statisztikák</span></a>
                    </li>@endcan
                    <li class="active"><a href="/home"><i class="fa fa-child"></i> <span>Saját fiók kezelése</span></a>
                    </li>
                </ul>
            @endcan

            {{--BOSS--}}
            @can('isDirectorateLeader')
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header"><b>FŐNÖKI MÓD</b></li>
                    <!-- Optionally, you can add icons to the links -->


                    <li>
                        <a href="/people/index"><i class="fa fa-users"></i> <span>Munkatársak</span>
                        </a>
                    </li>

                    <li class="treeview">
                        <a href="#"><i class="fa fa-plus"></i> <span>Bevételek</span>
                            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>

                         </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="/incomes/report"><i class="fa fa-table "></i>Összesítő</a></li>
                            <li><a href="/incomes/index">Listázás</a></li>


                        </ul>
                    </li>

                    <li class="treeview">
                        <a href="#"><i class="fa fa-minus"></i> <span>Kiadások</span>
                            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>

                         </span>
                        </a>
                        <ul class="treeview-menu">

                            <li><i class="fa fa-table "></i><a href="/costs/report"><i class="fa fa-table "></i>Összesítő
                                </a></li>
                            <li><a href="/costs/index">Listázás</a></li>


                        </ul>
                    </li>
                    <li><a href="/sites/statistic"><i class="fa fa-pie-chart"></i> <span>Statisztikák</span></a></li>

                    <li class="treeview">
                        <a href="#"><i class="fa fa-bank"></i> <span>Telephely</span>
                            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>

                         </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="/mysite"><i class="fa fa-bank "></i>{{Auth::user()->employee->site->name}}</a></li>
                            <li><a href="/sites/report"><i class="fa fa-table"></i>Telephelyi összesítő</a></li>
                            @can('isSites')
                                <li><a href="/sites/index">Összes telephely</a></li>
                                <li><a href="/sites/create">Új telephely felvétele</a></li>@endcan


                        </ul>
                    </li>
                    <li class="active"><a href="/home"><i class="fa fa-child"></i> <span>Saját fiók kezelése</span></a>
                    </li>

                </ul>
            @endcan

            {{--LEADER--}}
            @can('isLeader')
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header"><b>LEADER MÓD</b></li>
                    <!-- Optionally, you can add icons to the links -->


                    <li class="treeview">
                        <a href="#"><i class="fa fa-users"></i> <span>Munkatársak</span>
                            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>

                         </span>
                        </a>
                        <ul class="treeview-menu">

                            <li><a href="/people/index">Listázás</a></li>
                            <li><a href="/people/create">Új munkatárs rögzítése</a></li>
                            @can('isSites')<li><a href="/users/index"><i class="fa fa-user-o"></i>Jogosultság kezelés</a></li>@endcan

                        </ul>
                    </li>

                    <li class="treeview">
                        <a href="#"><i class="fa fa-bank"></i> <span>Telephely</span>
                            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>

                         </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="/mysite"><i class="fa fa-bank "></i>{{Auth::user()->employee->site->name}}</a></li>
                            <li></i><a href="/sites/report"><i class="fa fa-table "></i>Telephelyi összesítő</a></li>
                            @can('isSites')
                                <li><a href="/sites/index">Összes telephely</a></li>
                                <li><a href="/sites/create">Új telephely felvétele</a></li>@endcan


                        </ul>
                    </li>
                    <li ><a href="/sites/statistic"><i class="fa fa-pie-chart"></i>
                            <span>Statisztikák</span></a></li>
                    <li class="active"><a href="/home"><i class="fa fa-child"></i> <span>Saját fiók kezelése</span></a>
                    </li>

                </ul>
            @endcan
            {{--INCOMES--}}
            @can('isIncomes')
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header"><b>BEVÉTELEK KEZELÉSE MÓD</b></li>
                    <!-- Optionally, you can add icons to the links -->


                    <li class="treeview">
                        <a href="#"><i class="fa fa-plus"></i> <span>Bevételek</span>
                            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>

                         </span>
                        </a>
                        <ul class="treeview-menu">

                            <li><a href="/incomes/index">Listázás</a></li>
                            <li><a href="/incomes/create">Új bevétel rögzítése</a></li>
                            <li><a href="/incomes/create">Új bevétel típus rögzítése</a></li>
                            <li><a href="/incomes/report"><i class="fa fa-table "></i>Bevétel összesítő</a></li>

                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-handshake-o"></i> <span>Ügyfelek</span>
                            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                         </span>
                        </a>
                        <ul class="treeview-menu">

                            <li><a href="/costs/index">Listázás</a></li>
                            <li><a href="/costs/create">Új ügyfél rögzítése</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-bank"></i> <span>Telephely</span>
                            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>

                         </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="/mysite"><i class="fa fa-bank "></i>{{Auth::user()->employee->site->name}}</a></li>
                            <li><a href="/sites/report"><i class="fa fa-table "></i>Telephelyi összesítő</a></li>
                            @can('isSites')
                                <li><a href="/sites/index">Összes telephely</a></li>
                                <li><a href="/sites/create">Új telephely felvétele</a></li>@endcan


                        </ul>
                    </li>
                    <li class="active"><a href="/home"><i class="fa fa-child"></i> <span>Saját fiók kezelése</span></a>
                    </li>
                </ul>
            @endcan
            {{--COSTS--}}
            @can('isCosts')
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header"><b>KIADÁSOK KEZELÉSE MÓD</b></li>
                    <!-- Optionally, you can add icons to the links -->


                    <li class="treeview">
                        <a href="#"><i class="fa fa-minus"></i> <span>Kiadások</span>
                            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>

                         </span>
                        </a>
                        <ul class="treeview-menu">

                            <li><a href="/costs/index">Listázás</a></li>
                            <li><a href="/costs/create">Új kiadás rögzítése</a></li>
                            <li><a href="/cost_types/create">Új kiadás típus rögzítése</a></li>
                            <li><a href="/costs/report"><i class="fa fa-table "></i>Összesítő</a></li>


                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-truck"></i> <span>Beszállítók</span>
                            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>

                         </span>
                        </a>
                        <ul class="treeview-menu">

                            <li><a href="/suppliers/index">Listázás</a></li>
                            <li><a href="/suppliers/create">Új beszállító rögzítése</a></li>

                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="fa fa-bank"></i> <span>Telephely</span>
                            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>

                         </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="/mysite"><i class="fa fa-bank "></i>{{Auth::user()->employee->site->name}}</a></li>
                            <li><a href="/sites/report"><i class="fa fa-table "></i>Telephelyi összesítő</a></li>
                            @can('isSites')
                                <li><a href="/sites/index">Összes telephely</a></li>
                                <li><a href="/sites/create">Új telephely felvétele</a></li>@endcan
                        </ul>
                    </li>
                    <li class="active"><a href="/home"><i class="fa fa-child"></i> <span>Saját fiók kezelése</span></a>
                    </li>
                </ul>
        @endcan

        <!-- Sidebar user panel (optional) -->
            <div class="user-panel" style="padding-bottom: 50px">
                <div class="pull-left image">
                    <img src="/storage/images/{{ Auth::user()->employee->image }}"
                         style="border-radius: 50%; width: 40px; height: 40px;" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>

                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ Auth::user()->permission->name }}
                        Online</a>
                </div>
            </div>
            <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->


        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
              -------------------------->
            @yield('content')

            <div>
                @if (session('notification'))
                    <notification type="{{ session('notificationType') }}"
                                  message="{{ session('notification') }}"></notification>
                @elseif (session('status'))
                    <notification type="alert-primary" message="{{ session('status') }}"></notification>
                @else
                    <notification></notification>
                @endif
            </div>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
            <p><?php echo(Date("Y-m-d")) ?></p>
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2018 <a href="#">Anonymus Kft</a>.</strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
            <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <!-- Home tab content -->
            <div class="tab-pane active" id="control-sidebar-home-tab">
                <h3 class="control-sidebar-heading">Recent Activity</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript:">
                            <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                                <p>Will be 23 on April 24th</p>
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- /.control-sidebar-menu -->

                <h3 class="control-sidebar-heading">Tasks Progress</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript:;">
                            <h4 class="control-sidebar-subheading">
                                Custom Template Design
                                <span class="pull-right-container">
                    <span class="label label-danger pull-right">70%</span>
                  </span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- /.control-sidebar-menu -->

            </div>
            <!-- /.tab-pane -->
            <!-- Stats tab content -->
            <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
            <!-- /.tab-pane -->
            <!-- Settings tab content -->
            <div class="tab-pane" id="control-sidebar-settings-tab">
                <form method="post">
                    <h3 class="control-sidebar-heading">General Settings</h3>

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Report panel usage
                            <input type="checkbox" class="pull-right" checked>
                        </label>

                        <p>
                            Some information about this general settings option
                        </p>
                    </div>
                    <!-- /.form-group -->
                </form>
            </div>
            <!-- /.tab-pane -->
        </div>
    </aside>
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
    immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>

</div>

</body>
<script src="{{asset('js/app.js')}}"></script>


</html>