<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>LogCentral</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Styles -->
    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">
    <link href="{{ elixir('css/all.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <script src="https://use.fontawesome.com/7b46f4dd60.js"></script>
    <!-- App js -->
    <script src="{{ elixir('js/all.js') }}"></script>
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.dataTables.min.css">
    <script src="https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js"></script>
</head>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a href="{{action('Dashboard@index')}}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>L</b>C</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>LOG</b>Central</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->

                    <!-- /.messages-menu -->

                    <!-- Notifications Menu -->

                    <!-- Tasks Menu -->

                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <i class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i>
                            <!-- <img src="{{asset('img/user2-160x160.jpg')}}" class="user-image" alt="User Image"> -->
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">{{ Auth::user()->fullname() }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <i class="fa fa-user" aria-hidden="true" style="font-size: 7em;"></i>
                                <p>
                                    {{ Auth::user()->fullname() }} - Level : {{ Auth::user()->level_id }}
                                    <small>
                                        {{ trans('site.member_since') }}
                                         {{Auth::user()->created_at->format('M Y')}}
                                    </small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-right">
                                    <a href="{{ action('Login@signout') }}" class="btn btn-default btn-flat">{{ trans('site.sign_out') }}</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar Menu -->
            <ul class="sidebar-menu">
                <li class="header">{{trans('site.menu')}}</li>
                <!-- Optionally, you can add icons to the links -->
                <li class="{{set_active('/')}}">
                    <a href="{{action('Dashboard@index')}}">
                        <i class="fa fa-home" aria-hidden="true"></i>
                        <span>{{trans('site.dashboard')}}</span>
                    </a>
                </li>
                <li class="{{set_active('projects*')}}">
                    <a href="{{action('Projects@index')}}">
                        <i class="fa fa-road" aria-hidden="true"></i>
                        <span>{{trans('site.projects')}}</span>
                    </a>
                </li>
                <li class="{{set_active('streams*')}}">
                    <a href="{{action('Streams@index')}}">
                        <i class="fa fa-cube" aria-hidden="true"></i>
                        <span>{{trans('site.streams')}}</span>
                    </a>
                </li>
                <li class="{{set_active('logs*')}}">
                    <a href="{{action('Logs@index')}}">
                        <i class="fa fa-book" aria-hidden="true"></i>
                        <span>{{trans('site.logs')}}</span>
                    </a>
                </li>
                @if(Auth::user()->level_id == 7)
                    <li class="{{ set_active('admin*') }} treeview">
                        <a href="#">
                            <i class="fa fa-cog"></i> <span>{{ trans('site.admin') }}</span> <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ set_active('admin/users*') }}">
                                <a href="{{ action('Admin\Users@index') }}">
                                    <i class="fa fa-circle-o"></i>
                                    {{ trans('admin.users') }}
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
            <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content-header">
            @yield('content-header')
        </section>
        <!-- Main content -->
        <section class="content">
            @include('partials.errors')
            @include('partials.messages')
            @yield('content')
        </section>
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <div class="pull-right ">
            <div class="">
                <a href="http://dustycode.com">
                    DustyCode <i class="fa fa-code" aria-hidden="true"></i>
                </a>
            </div>
        </div>
        <b>
            LogCentral
        </b>

    </footer>
</div>
<!-- ./wrapper -->

<!-- Optionally, you can add Slimscroll and FastClick plugins.
 Both of these plugins are recommended to enhance the
 user experience. Slimscroll is required when using the
 fixed layout. -->
</body>
<script>
    $(function () {
        $('.icheckinput').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });

        //Initialize Select2 Elements
        $(".select2").select2({
            width: '100%'
        });

        //Initialize datepickers
        $(".datepicker").datepicker({
            autoclose: true
        });

        //Timepicker
        $(".timepicker").timepicker({
            showInputs: false,
            showMeridian: false
        });

        //switch
        $(".switch-b").bootstrapSwitch();

        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
    });
</script>
@yield('scripts')
</html>
