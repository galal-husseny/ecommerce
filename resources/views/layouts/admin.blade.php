<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>@yield('title')</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />

    <!-- Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">

    <!-- css -->
    @php
        $mode = Cookie::get(Auth::guard('admin')->id()) ?? "light" ;
        $cssFile = "style-{$mode}.css";
    @endphp
    <link rel="stylesheet" type="text/css"
        href="{{ asset("assets/admin/css/$cssFile") }}" />
    @stack('css')
</head>

<body>

    <div class="wrapper">


        {{-- <div id="pre-loader">
            <img src="images/pre-loader/loader-01.svg" alt="">
        </div> --}}



        <nav class="admin-header navbar navbar-default col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <!-- logo -->
            <div class="text-left navbar-brand-wrapper">
                <a class="navbar-brand brand-logo" href="index.html"><img
                        src="{{ asset('assets/admin/images/logo-dark.png') }}" alt=""></a>
                <a class="navbar-brand brand-logo-mini" href="index.html"><img
                        src="{{ asset('assets/admin/images/logo-icon-dark.png') }}" alt=""></a>
            </div>
            <!-- Top bar left -->
            <ul class="nav navbar-nav mr-auto">
                <li class="nav-item">
                    <a id="button-toggle" class="button-toggle-nav inline-block ml-20 pull-left"
                        href="javascript:void(0);"><i class="zmdi zmdi-menu ti-align-right"></i></a>
                </li>
                <li class="nav-item">
                    <div class="search">
                        <a class="search-btn not_click" href="javascript:void(0);"></a>
                        <div class="search-box not-click">
                            <input type="text" class="not-click form-control" placeholder="Search" value=""
                                name="search">
                            <button class="search-button" type="submit"> <i
                                    class="fa fa-search not-click"></i></button>
                        </div>
                    </div>
                </li>
            </ul>
            <!-- top bar right -->
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item fullscreen">
                    <a id="btnFullscreen" href="#" class="nav-link"><i class="ti-fullscreen"></i></a>
                </li>
                <li class="nav-item fullscreen">
                    @if (Cookie::get(Auth::guard('admin')->id()) == 'dark')
                        <a id="btnFullscreen" href="{{ route('theme', 'light') }}" class="nav-link"
                            title="الوضع المُضيئ">
                            <i class="fa fa-sun-o" aria-hidden="true"></i>
                        </a>
                    @else
                        <a id="btnFullscreen" href="{{ route('theme', 'dark') }}" class="nav-link"
                            title="الوضع المُظلم">
                            <i class="fa fa-moon-o" aria-hidden="true"></i>
                        </a>
                    @endif
                </li>
                <li class="nav-item dropdown ">
                    <a class="nav-link top-nav" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="ti-bell"></i>
                        <span class="badge badge-danger notification-status"> </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-big dropdown-notifications">
                        <div class="dropdown-header notifications">
                            <strong>Notifications</strong>
                            <span class="badge badge-pill badge-warning">05</span>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">New registered user <small
                                class="float-right text-muted time">Just now</small> </a>
                        <a href="#" class="dropdown-item">New invoice received <small
                                class="float-right text-muted time">22 mins</small> </a>
                        <a href="#" class="dropdown-item">Server error report<small
                                class="float-right text-muted time">7 hrs</small> </a>
                        <a href="#" class="dropdown-item">Database report<small class="float-right text-muted time">1
                                days</small> </a>
                        <a href="#" class="dropdown-item">Order confirmation<small
                                class="float-right text-muted time">2 days</small> </a>
                    </div>
                </li>
                <li class="nav-item dropdown ">
                    <a class="nav-link top-nav" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                        aria-expanded="true"> <i class=" ti-view-grid"></i> </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-big">
                        <div class="dropdown-header">
                            <strong>Quick Links</strong>
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="nav-grid">
                            <a href="#" class="nav-grid-item"><i class="ti-files text-primary"></i>
                                <h5>New Task</h5>
                            </a>
                            <a href="#" class="nav-grid-item"><i class="ti-check-box text-success"></i>
                                <h5>Assign Task</h5>
                            </a>
                        </div>
                        <div class="nav-grid">
                            <a href="#" class="nav-grid-item"><i class="ti-pencil-alt text-warning"></i>
                                <h5>Add Orders</h5>
                            </a>
                            <a href="#" class="nav-grid-item"><i class="ti-truck text-danger "></i>
                                <h5>New Orders</h5>
                            </a>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown mr-30">
                    <a class="nav-link nav-pill user-avatar" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">
                        <img src="{{ Auth::guard('admin')->user()->getFirstMediaUrl('admins')? asset(Auth::guard('admin')->user()->getFirstMediaUrl('admins')): asset('assets/admin/images/default.png') }}"
                            alt="avatar">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-header">
                            <div class="media">
                                <div class="media-body">
                                    <h5 class="mt-0 mb-0">{{ Auth::guard('admin')->user()->name }}</h5>
                                    <span>{{ Auth::guard('admin')->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('profile') }}"><i
                                class="text-warning ti-user"></i>الصفحة الشخصية</a>
                        <a class="dropdown-item" href="#"><i class="text-info ti-settings"></i>اعدادات الموقع</a>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            <i class="text-danger ti-unlock"></i> تسجيل خروج
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </nav>



        <div class="container-fluid">
            <div class="row">

                <div class="side-menu-fixed">
                    <div class="scrollbar side-menu-bg">
                        <ul class="nav navbar-nav side-menu" id="sidebarnav">
                            <!-- menu item Dashboard-->
                            <li class="@if (Route::is('dashboard')) active @endif">
                                <a href="{{ route('dashboard') }}">
                                    <div class="pull-left"><i class="ti-home"></i><span
                                            class="right-nav-text"> الصفحة الرئيسية </span>
                                    </div>

                                    <div class="clearfix"></div>
                                </a>

                            </li>
                            <!-- menu title -->
                            <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">المنتجات </li>
                            <!-- menu item Elements-->
                            @if (can('Index Products', 'admin') || can('Index Categories', 'admin'))
                                <li>
                                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#categories-products"
                                        @if (Request::is('admin/categories*') || Request::is('admin/products*')) class="" aria-expanded="true" @endif>
                                        <div class="pull-left"><i class="ti-palette"></i><span
                                                class="right-nav-text">الأقسام والمنتجات </span></div>
                                        <div class="pull-right"><i class="ti-plus"></i></div>
                                        <div class="clearfix"></div>
                                    </a>
                                    <ul id="categories-products"
                                        class="collapse @if (Request::is('admin/products*') || Request::is('admin/categories*')) show @endif"
                                        data-parent="#sidebarnav">
                                        @if (can('Index Categories', 'admin'))
                                            <li class="@if (Request::is('admin/categories*')) active @endif"><a
                                                    href="{{ route('categories.index') }}">الأقسام</a></li>
                                        @endif
                                        @if (can('Index Products', 'admin'))
                                            <li class="@if (Request::is('admin/products*')) active @endif"><a
                                                    href="{{ route('products.index') }}">المنتجات</a></li>
                                        @endif

                                    </ul>
                                </li>
                            @endif
                            {{-- @if (can('Index Sellers', 'admin') || can('Index Shops', 'admin')) --}}
                                <li>
                                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#Shops-Sellers"
                                        @if (Request::is('admin/sellers*') || Request::is('admin/shops*')) class="" aria-expanded="true" @endif>
                                        <div class="pull-left"><i class="ti-palette"></i><span
                                                class="right-nav-text">المحلات والتجار </span></div>
                                        <div class="pull-right"><i class="ti-plus"></i></div>
                                        <div class="clearfix"></div>
                                    </a>
                                    <ul id="Shops-Sellers"
                                        class="collapse @if (Request::is('admin/sellers*') || Request::is('admin/shops*')) show @endif"
                                        data-parent="#sidebarnav">
                                        {{-- @if (can('Index Shops', 'admin')) --}}
                                            <li class="@if (Request::is('admin/shops*')) active @endif"><a
                                                    href="{{ route('shops.index') }}">المحلات</a></li>
                                        {{-- @endif --}}
                                         {{-- @if (can('Index Sellers', 'admin')) --}}
                                            <li class="@if (Request::is('admin/sellers*')) active @endif"><a
                                                    href="{{ route('sellers.index') }}">التجار</a></li>
                                        {{-- @endif --}}

                                    </ul>
                                </li>
                            {{-- @endif --}}
                            @if (can('Index Brands', 'admin') || can('Index Models', 'admin'))
                                <li>
                                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#brands-models"
                                        @if (Request::is('admin/brands*') || Request::is('admin/models*')) class="" aria-expanded="true" @endif>
                                        <div class="pull-left"><i class="ti-palette"></i><span
                                                class="right-nav-text">العلامات التجارية والموديلات</span></div>
                                        <div class="pull-right"><i class="ti-plus"></i></div>
                                        <div class="clearfix"></div>
                                    </a>
                                    <ul id="brands-models"
                                        class="collapse @if (Request::is('admin/brands*') || Request::is('admin/models*')) show @endif"
                                        data-parent="#sidebarnav">
                                        @if (can('Index Brands', 'admin'))
                                            <li class="@if (Request::is('admin/brands*')) active @endif"><a
                                                    href="{{ route('brands.index') }}">العلامات التجارية</a></li>
                                        @endif
                                        @if (can('Index Models', 'admin'))
                                            <li class="@if (Request::is('admin/models*')) active @endif"><a
                                                    href="{{ route('models.index') }}">الموديلات</a></li>
                                        @endif

                                    </ul>
                                </li>
                            @endif
                            @if (can('Index Cities', 'admin') || can('Index Regions', 'admin'))
                                <li>
                                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#cities-regions"
                                        @if (Request::is('admin/cities*') || Request::is('admin/regions*')) class="" aria-expanded="true" @endif>
                                        <div class="pull-left"><i class="ti-palette"></i><span
                                                class="right-nav-text">المدن والمناطق</span></div>
                                        <div class="pull-right"><i class="ti-plus"></i></div>
                                        <div class="clearfix"></div>
                                    </a>
                                    <ul id="cities-regions"
                                        class="collapse @if (Request::is('admin/cities*') || Request::is('admin/regions*')) show @endif"
                                        data-parent="#sidebarnav">
                                        @if (can('Index Cities', 'admin'))
                                            <li class="@if (Request::is('admin/cities*')) active @endif"><a
                                                    href="{{ route('cities.index') }}">المدن</a></li>
                                        @endif
                                        @if (can('Index Regions', 'admin'))
                                            <li class="@if (Request::is('admin/regions*')) active @endif"><a
                                                    href="{{ route('regions.index') }}">المناطق</a></li>
                                        @endif
                                    </ul>
                                </li>
                            @endif

                            @if (can('Index Roles', 'admin') || can('Index Admins', 'admin'))
                                <li>
                                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#admins-roles"
                                        @if (Request::is('admin/admins*') || Request::is('admin/roles*')) class="" aria-expanded="true" @endif>
                                        <div class="pull-left"><i class="ti-palette"></i><span
                                                class="right-nav-text"> المُشرفين والوظائف</span></div>
                                        <div class="pull-right"><i class="ti-plus"></i></div>
                                        <div class="clearfix"></div>
                                    </a>
                                    <ul id="admins-roles"
                                        class="collapse @if (Request::is('admin/admins*') || Request::is('admin/roles*')) show @endif"
                                        data-parent="#sidebarnav">
                                        @if (can('Index Admins', 'admin'))
                                            <li class="@if (Request::is('admin/admins*')) active @endif"><a
                                                    href="{{ route('admins.index') }}">المُشرفين</a></li>
                                        @endif
                                        @if (can('Index Roles', 'admin'))
                                            <li class="@if (Request::is('admin/roles*')) active @endif"><a
                                                    href="{{ route('roles.index') }}">الوظائف</a></li>
                                        @endif
                                    </ul>
                                </li>
                            @endif

                        </ul>
                    </div>
                </div>


                <div class="content-wrapper">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-sm-6">
                                <h4>@yield('breadcrumb')</h4>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            @if (session('success'))
                                <div class="alert alert-success text-center">
                                    {{ session('success') }}
                                </div>
                            @elseif(session('error'))
                                <div class="alert alert-danger text-center">
                                    {{ session('error') }}
                                </div>
                            @endif
                        </div>
                        @yield('content')
                    </div>
                    {{-- <div class="row">
                        <div class="col-12 ">
                            <footer class="bg-white p-4 w-100" style="position: fixed;bottom:0%">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="text-center text-md-left">
                                            <p class="mb-0"> &copy; Copyright <span id="copyright">
                                                    <script>
                                                        document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
                                                    </script>
                                                </span>. <a href="#"> Webmin </a> All Rights Reserved. </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <ul class="text-center text-md-right">
                                            <li class="list-inline-item"><a href="#">Terms & Conditions </a> </li>
                                            <li class="list-inline-item"><a href="#">API Use Policy </a> </li>
                                            <li class="list-inline-item"><a href="#">Privacy Policy </a> </li>
                                        </ul>
                                    </div>
                                </div>
                            </footer>
                        </div>
                    </div> --}}


                </div>
            </div>
        </div>
    </div>

    <!-- jquery -->
    <script src="{{ asset('assets/admin/js/jquery-3.3.1.min.js') }}"></script>

    <!-- plugins-jquery -->
    <script src="{{ asset('assets/admin/js/plugins-jquery.js') }}"></script>

    <!-- plugin_path -->
    <script>
        var plugin_path = '{{ asset('assets/admin/js') }}/';
    </script>

    <!-- chart -->
    <script src="{{ asset('assets/admin/js/chart-init.js') }}"></script>

    <!-- calendar -->
    <script src="{{ asset('assets/admin/js/calendar.init.js') }}"></script>

    <!-- charts sparkline -->
    <script src="{{ asset('assets/admin/js/sparkline.init.js') }}"></script>

    <!-- charts morris -->
    <script src="{{ asset('assets/admin/js/morris.init.js') }}"></script>

    <!-- datepicker -->
    <script src="{{ asset('assets/admin/js/datepicker.js') }}"></script>

    <!-- sweetalert2 -->
    <script src="{{ asset('assets/admin/js/sweetalert2.js') }}"></script>

    <!-- toastr -->
    <script src="{{ asset('assets/admin/js/toastr.js') }}"></script>

    <!-- validation -->
    <script src="{{ asset('assets/admin/js/validation.js') }}"></script>



    <!-- lobilist -->
    <script src="{{ asset('assets/admin/js/lobilist.js') }}"></script>

    <!-- custom -->
    <script src="{{ asset('assets/admin/js/custom.js') }}"></script>
    @stack('js')
</body>

</html>
