<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- <link rel="stylesheet" href="{{ asset('css/overlayScrollbars/css/OverlayScrollbars.min.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
   
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper" id="app">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- SEARCH FORM -->
            <div class="form-inline ml-3">
                <div class="input-group-prepend">
                    <input v-model="search" class="form-control form-control-navbar" type="search" placeholder="Search"
                        aria-label="Search" @keyup="getSearch()">
                    <div class="input-group-append">
                        <button @click.prevent="getSearch()" class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
 
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="brand-link">
                <img src="{{ asset('img/logo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-transition os-host-scrollbar-horizontal-hidden">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('img/profile/' . Auth::user()->photo) }}" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="/profile" class="d-block">{{ Auth::user()->name }}</a>
                        <span class="d-block text-muted">
                            {{ Auth::user()->type }}
                        </span>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="{{ url('/') }}" to="/" tag="a" exact class="nav-link" active-class="active">
                                <i class="nav-icon fas fa-tachometer-alt blue"></i>
                                <p>
                                    Home
                                </p>
                            </a>
                        </li>
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-briefcase"></i>
                                <p>
                                    Browse
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <router-link to="/annualreports" exact tag="a" class="nav-link" active-class="active">
                                        <i class="fas fa-folder-open nav-icon purple"></i>
                                        <p>Annual Reports</p>
                                    </router-link>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <router-link to="/policybriefs" exact tag="a" class="nav-link" active-class="active" >
                                        <i class="fas fa-sticky-note nav-icon purple"></i>
                                        <p>Policy Briefs</p>
                                    </router-link>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <router-link to="/proceedings" exact tag="a" class="nav-link" active-class="active">
                                        <i class="fas fa-file nav-icon purple"></i>
                                        <p>Proceedings</p>
                                    </router-link>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <router-link to="/projectcompletions" exact tag="a" class="nav-link" active-class="active">
                                        <i class="fas fa-file nav-icon purple"></i>
                                        <p>Project Completion</p>
                                    </router-link>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <router-link to="/publications" exact tag="a" class="nav-link" active-class="active">
                                        <i class="fas fa-file nav-icon purple"></i>
                                        <p>Publication</p>
                                    </router-link>
                                </li>
                            </ul>


                            

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <router-link to="/videos" exact tag="a" class="nav-link" active-class="active">
                                        <i class="fas fa-folder-open nav-icon purple"></i>
                                        <p>Video</p>
                                    </router-link>
                                </li>
                            </ul>                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <router-link to="/abo" exact tag="a" class="nav-link" active-class="active">
                                        <i class="fas fa-folder-open nav-icon purple"></i>
                                        <p>ASEAN Biodiversity Outlook</p>
                                    </router-link>
                                </li>
                            </ul>
                            
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <router-link to="/bimgbdocs" exact tag="a" class="nav-link" active-class="active">
                                        <i class="fas fa-folder-open nav-icon purple"></i>
                                        <p>BIM 23 GB Documents</p>
                                    </router-link>
                                </li>
                            </ul>
                            
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <router-link to="/bimworkshopfiles" exact tag="a" class="nav-link" active-class="active">
                                        <i class="fas fa-folder-open nav-icon purple"></i>
                                        <p>2016 BIM Workshop Files</p>
                                    </router-link>
                                </li>
                            </ul>
                            
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <router-link to="/kmproducts" exact tag="a" class="nav-link" active-class="active">
                                        <i class="fas fa-folder-open nav-icon purple"></i>
                                        <p>KM Plan and Product Development</p>
                                    </router-link>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <router-link to="/gofbudgets" exact tag="a" class="nav-link" active-class="active">
                                        <i class="fas fa-folder-open nav-icon purple"></i>
                                        <p>GOF Budget Appropriations
</p>
                                    </router-link>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <router-link to="/activitydesigns" exact tag="a" class="nav-link" active-class="active">
                                        <i class="fas fa-folder-open nav-icon purple"></i>
                                        <p>Activity Design</p>
                                    </router-link>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <router-link to="/kbacourses" exact tag="a" class="nav-link" active-class="active">
                                        <i class="fas fa-folder-open nav-icon purple"></i>
                                        <p>KBA Course Prep Documents</p>
                                    </router-link>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <router-link to="/abds" exact tag="a" class="nav-link" active-class="active">
                                        <i class="fas fa-folder-open nav-icon purple"></i>
                                        <p>ASEAN Biodiversity Dashboard Surveys</p>
                                    </router-link>
                                </li>
                            </ul>
                        </li>
                        @canany(['isAdmin','isAuthor'])
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-cog green"></i>
                                <p>
                                    Management
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <router-link to="/users" exact tag="a" class="nav-link" active-class="active">
                                        <i class="fas fa-users nav-icon purple"></i>
                                        <p>Users</p>
                                    </router-link>
                                </li>
                            </ul>
                        </li>
                        @endcan
                        <li class="nav-item">
                            <router-link to="/profile" tag="a" exact class="nav-link" active-class="active">
                                <i class="nav-icon fas fa-user orange"></i>
                                <p>
                                    My Account
                                </p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="nav-icon fas fa-power-off red"></i>
                                <p>{{ __('Logout') }}</p>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                class="d-none">
                                @csrf
                            </form>

                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->

            </div>
            <!-- /.sidebar -->
 
        </aside>

        

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper pt-1">

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">

                    <div class="row">
                        <!--  router view -->
                        <router-view></router-view>
                        <!-- set progressbar -->
                        <vue-progress-bar></vue-progress-bar>
                    </div>

                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">

            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; Biodiversity Information Management</strong> All rights
            reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!--  App -->
    @auth
        <script>
            window.user = @JSON(auth()->user())
       
        </script>
    @endauth
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
