<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>@yield('title')</title>
    {{-- bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Fontfaces CSS-->
    <link href="{{ asset('admin/css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet"
        media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ asset('admin/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{ asset('admin/vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet"
        media="all">
    <link href="{{ asset('admin/vendor/wow/animate.css" rel="stylesheet') }}" media="all">
    <link href="{{ asset('admin/vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/slick/slick.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{ asset('admin/css/theme.css') }}" rel="stylesheet" media="all">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="mt-3 ms-2">
                <a href="{{ route('user#shop') }}" class="text-decoration-none">
                    <span class="px-2 h1 text-uppercase text-primary bg-dark">Pizza</span>
                    <span class="px-2 h1 text-uppercase text-dark bg-primary ml-n1">buddy</span>
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li @yield('product_focus')>
                            <a class="js-arrow" href="{{ route('admin#products#list') }}">
                                <i class="fa-solid fa-pizza-slice"></i>Products
                            </a>
                        </li>
                        <li @yield('order_focus')>
                            <a class="js-arrow" href="{{ route('admin#orders#list') }}">
                                <i class="fa-solid fa-clipboard-list"></i>Orders
                            </a>
                        </li>
                        <li @yield('category_focus')>
                            <a class="js-arrow" href="{{ route('admin#categories#list') }}">
                                <i class="fa-solid fa-folder-tree"></i>Category</a>
                        </li>

                        <li @yield('customer_focus')>
                            <a class="js-arrow" href="{{route('admin#customer#list')}}">
                                <i class="fa-solid fa-users"></i>Customers</a>
                        </li>
                        <li @yield('admin_list_focus')>
                            <a class="js-arrow" href="{{ route('admin#list') }}">
                                <i class="fa-solid fa-user-shield"></i>Admin List</a>
                        </li>
                    </ul>

                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap ">
                            {{-- SERACH FORM START --}}
                            @yield('searchbar')
                            {{-- SERACH FORM END --}}
                            <div class="header-button ms-auto">

                                <div class="account-wrap">
                                    <div class="clearfix account-item js-item-menu">
                                        <div class="image">
                                            @if (Auth::user()->profile_photo_path)
                                                <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}"
                                                    alt="{{ Auth::user()->name }}" />
                                            @else
                                                <img src="{{ asset('image/defaultprofile.png') }}"
                                                    alt="{{ Auth::user()->name }}" />
                                            @endif
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#">{{ Auth::user()->name }}</a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="clearfix info">
                                                <div class="image">
                                                    @if (Auth::user()->profile_photo_path)
                                                        <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}"
                                                            alt="{{ Auth::user()->name }}" />
                                                    @else
                                                        <img src="{{ asset('image/defaultprofile.png') }}"
                                                            alt="{{ Auth::user()->name }}" />
                                                    @endif
                                                </div>

                                                <div class="content">
                                                    <h5 class="name">
                                                        <a
                                                            href="{{ route('admin#account#profilepage') }}">{{ Auth::user()->name }}</a>
                                                    </h5>
                                                    <span class="email">{{ Auth::user()->email }}</span>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                                <div class="account-dropdown__item">
                                                    <a href="{{ route('admin#account#changepasswordpage') }}">
                                                        <i class="zmdi zmdi-key"></i>Change password</a>
                                                </div>
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <form action="{{ route('logout') }}" method="post"
                                                    class="form-control">
                                                    @csrf
                                                    <button type="submit" class="form-control btn btn-info">
                                                        <i class="mx-3 zmdi zmdi-power"></i>Logout
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!--END HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            @yield('content')
            <!-- END MAIN CONTENT-->
        </div>
        <!-- END PAGE CONTAINER-->

    </div>

    <!-- Jquery JS-->
    <script src="{{ asset('admin/vendor/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap JS-->
    <script src="{{ asset('admin/vendor/bootstrap-4.1/popper.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
    <!-- Vendor JS       -->
    <script src="{{ asset('admin/vendor/slick/slick.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/wow/wow.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/animsition/animsition.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/counter-up/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/counter-up/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('admin/vendor/chartjs/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/select2/select2.min.js') }}"></script>

    <!-- Main JS-->
    <script src="{{ asset('admin/js/main.js') }}"></script>

</body>
@stack('editPage')
@stack('script')
</html>
<!-- end document-->
