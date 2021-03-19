<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{__('main.title')}}</title>

@yield('css')
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="/adminlte/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/adminlte/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">


    <link rel="stylesheet" href="/css/app.css">

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light ">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
        <!-- Right navbar links -->

        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown  user-men">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span style="font-size:60%; margin-right:-5px;" class="badge badge-warning navbar-badge">{{ $countNotifications }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-header">{{ $countNotifications }} {{__('notification.notRead')}} @if($countNotifications>0)- <a href="{{ route('notifications.readAll') }}">(Tout marquer comme lu)</a> @endif</span>
                    @foreach($notifications as $notif)
                        <x-navNotification count="{{$notif['count']}}" route="{{$notif['route']}}" icon="{{$notif['icon']}}"/>
                    @endforeach
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('notifications.index') }}" class="dropdown-item dropdown-footer">{{__('notification.seeAll')}}</a>
                </div>
            </li>
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                    @if ($currentUser->email)
                    <img src="{{ Gravatar::get($currentUser->email) }}" class="user-image img-circle elevation-2" alt="User Image">
                    @endif
                    <span class="d-none d-md-inline">{{$currentUser->name}}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <!-- User image -->
                    <li class="user-header bg-cyan">
                        @if ($currentUser->email)
                        <img src="{{ Gravatar::get($currentUser->email) }}" class="img-circle elevation-2" alt="User Image">
                        @endif
                        <p>
                            @foreach($currentUser->getRoles() as $role)

                                @if( $loop->index > 0)
                                    ...
                                    @break
                                @endif
                                {{ \App\Role\UserRole::getHumanRole($role) }}
                                @if( ! $loop->last)
                                     |
                                @endif
                            @endforeach
                            <small>{{ date('d-m-Y') }}</small>
                        </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <a href="{{ route('myProfile.my-account', $currentUser)}}" class="btn btn-default btn-flat">{{__('main.myAccount')}}</a>
                        <a href="{{ route('logout') }}"  onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();" class="btn btn-default btn-flat float-right">{{__('main.logout')}}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ route('home') }}" class="brand-link bg-cyan">
            <img src="/images/tdc.jpg" alt="Tour de commandement Logo" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">{{__('main.adminTitle.prefix')}} {{__('main.adminTitle.title')}}</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <x-menu-item href="{{ route('dashboard') }}" :sub=false icon="home" active="{{ Route::currentRouteName() === 'dashboard' }}">
                        {{__('main.menu.dashboard')}}
                    </x-menu-item>
                    @if(\App\Role\RoleChecker::check($currentUser,\App\Rights\ArticleRights::getInterfaceAccess()))
                        <li class="nav-item has-treeview {{ ( Request::routeIs('article*') && ! Request::routeIs('article*edit'))  ? 'menu-open' : 'menu-close' }} ">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-newspaper"></i>
                                <p>
                                    {{__('main.menu.articles.title')}}
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <x-menu-item href="{{ route('article.index') }}" :sub=false icon="file-alt" active="{{ Route::currentRouteName() === 'article.index' }}">
                                    {{__('main.menu.articles.list')}}
                                </x-menu-item>
                            </ul>
                        </li>
                    @endif
                    @if(\App\Role\RoleChecker::check($currentUser,\App\Rights\ProfileRights::getInterfaceAccess()))
                    <li class="nav-item has-treeview {{ ( Request::routeIs('profile*') && ! Request::routeIs('profile*edit'))  ? 'menu-open' : 'menu-close' }} ">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                {{__('main.menu.users.title')}}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <x-menu-item href="{{ route('profile.index') }}" :sub=false icon="address-book" active="{{ Route::currentRouteName() === 'profile.index' }}">
                                {{__('main.menu.users.list')}}
                            </x-menu-item>
                            @if(\App\Role\RoleChecker::check($currentUser,\App\Rights\ProfileRights::getInterfaceAccess('create')))
                                <x-menu-item href="{{ route('profile.create') }}" :sub=false icon="user-plus" active="{{ Route::currentRouteName() === 'profile.create' }}">
                                    {{__('main.menu.users.add')}}
                                </x-menu-item>
                            @endif
                        </ul>
                    </li>
                    @endif
                    @if(\App\Role\RoleChecker::check($currentUser,\App\Rights\NotificationRights::getInterfaceAccess()))
                    <x-menu-item href="{{ route('notifications.index') }}"
                                 :sub=false
                                 icon="bell"
                                 active="{{ Route::currentRouteName() === 'notifications.index' }}"
                                 badge="{{($countNotifications > 0)}}"
                                 badgeIcon='warning'
                                 badgeText="{{$countNotifications}}"

                    >
                        {{__('main.menu.notification')}}
                    </x-menu-item>
                    @endif
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{ $title }}</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                @if (session('msg-error'))
                    <div class="alert alert-danger">
                        {{ session('msg-error') }}
                    </div>
                @endif
                @if (session('msg-valid'))
                    <div class="alert alert-success">
                        {{ session('msg-valid') }}
                    </div>
                @endif
                @yield('content')
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
            {{__('main.footer.flevor')}}
        </div>
        <!-- Default to the left -->
        <strong>{{__('main.footer.copyright', ['date'=>date('Y')])}} </strong> {{__('main.footer.rights')}}
    </footer>
</div>
<section id="loading">
    <div id="loading-content"></div>
</section>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="/adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/adminlte/js/adminlte.min.js"></script>
<script src="{{ asset('js/spinner.js') }}"></script>
@yield('js')
</body>
</html>
