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
    <title>Ministere de la Justice - Admin</title>

    <link href="{{ asset('assets/images/icon/minjus.jpg') }}" rel="icon" media="all">

    <!-- Fontfaces CSS-->
    <link href="{{ asset('assets/css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('assets/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('assets/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('assets/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ asset('assets/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{ asset('assets/vendor/animsition/animsition.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('assets/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('assets/vendor/wow/animate.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('assets/vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('assets/vendor/slick/slick.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('assets/vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('assets/vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">

    <!-- Main CSS-->
    <link href="{{ asset('assets/css/theme.css') }}" rel="stylesheet" media="all">

</head>
<body class="animsition">
<div class="page-wrapper">
    <!-- MENU SIDEBAR-->
    <aside class="menu-sidebar2">
        <div class="logo bg-light">
            <a href="#">
                <img src="{{ asset('assets/images/icon/logo.png') }}" alt="CoolAdmin" />
            </a>
        </div>
        <div class="menu-sidebar2__content js-scrollbar1">
            <div class="account2">
                <div class="image img-cir img-120">
                    <img src="https://www.stage.itu-labs.com/Assets/img/user2-160x160.jpg" alt="John Doe" />
                </div>
                <h4 class="name">{{ Auth::user()->name }}</h4>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')"
                                     onclick="event.preventDefault();
                                                this.closest('form').submit();">
                        <i class="zmdi zmdi-power"></i>
                        {{ __('Se deconnecter') }}
                    </x-dropdown-link>
                </form>
                {{--                <a href="#">Sign out</a>--}}
            </div>
            <nav class="navbar-sidebar2">
                <ul class="list-unstyled navbar__list">
                    <li>
                        <a href="/">
                            <i class="fas fa-chart-bar"></i>Tableau de bord</a>
                    </li>
                    <li>
                        <a href="{{ route('Utilisateur') }}">
                            <i class="fas fa-user"></i>Utilisateurs</a>
                    </li>
                    <li>
                        <a href="{{ route('Camp') }}">
                            <i class="fas fa-leaf"></i>Camp penal</a>
                    </li>
                    <li>
                        <a href="{{ route('Carte') }}">
                            <i class="fas fa-map-marker-alt"></i>Carte</a>
                    </li>
                    <li>
                        <a href="{{ route('Situation') }}">
                            <i class="fas fa-list-alt"></i>Situation judiciaire </a>
                    </li>
{{--                    <li>--}}
{{--                        <a href="{{ route('Culture') }}">--}}
{{--                            <i class="fab fa-pagelines"></i>Liste des cultures</a>--}}
{{--                    </li>--}}

                </ul>
            </nav>
        </div>
    </aside>
    <!-- END MENU SIDEBAR-->

    <!-- PAGE CONTAINER-->
    <div class="page-container2">
        <!-- HEADER DESKTOP-->
        <header class="header-desktop2 bg-dark" >
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="header-wrap2">
                        <div class="logo d-block d-lg-none">
                            <a href="#">
                                <img src="{{ asset('assets/images/icon/logo.png') }}" alt="CoolAdmin" />
                            </a>
                        </div>
                        <div class="header-button2">
                            <div class="header-button-item">
                                <a href="{{ route('message') }}" style="color: #fff;">
                                    <i class="zmdi zmdi-comment"></i>
                                    @if( \App\Models\Messages::CountMessage() > 0 )
                                        <sup class="text-success" >({{ \App\Models\Messages::CountMessage() }})</sup>
                                    @endif
                                </a>
                            </div>
                            <div class="header-button-item mr-0 js-sidebar-btn">
                                <i class="zmdi zmdi-menu"></i>
                            </div>
                            <div class="setting-menu js-right-sidebar d-none d-lg-block">
                                <div class="account-dropdown__body">
                                    <div class="account-dropdown__item">
                                        <a href="{{ route('profile.edit') }}">
                                            <i class="zmdi zmdi-account"></i>Profile Utilisateur</a>
                                    </div>
                                    <div class="account-dropdown__item">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <x-dropdown-link :href="route('logout')"
                                                             onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                                <i class="zmdi zmdi-power"></i>
                                                {{ __('Se deconnecter') }}
                                            </x-dropdown-link>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <aside class="menu-sidebar2 js-right-sidebar d-block d-lg-none">
            <div class="logo">
                <a href="#">
                    <img src="{{ asset('assets/images/icon/logo.png') }}" alt="CoolAdmin" />
                </a>
            </div>
            <div class="menu-sidebar2__content js-scrollbar2">
                <div class="account2">
                    <div class="image img-cir img-120">
                        <img src="https://www.stage.itu-labs.com/Assets/img/user2-160x160.jpg" alt="John Doe" />
                    </div>
                    <h4 class="name">{{ Auth::user()->name }}</h4>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                                         onclick="event.preventDefault();
                                                this.closest('form').submit();">
                            <i class="zmdi zmdi-power"></i>
                            {{ __('Se deconnecter') }}
                        </x-dropdown-link>
                    </form>
                </div>
                <nav class="navbar-sidebar2">
                    <ul class="list-unstyled navbar__list">
                        <li>
                            <a href="/">
                                <i class="fas fa-chart-bar"></i>Tableau de bord</a>
                        </li>
                        <li>
                            <a href="{{ route('Utilisateur') }}">
                                <i class="fas fa-user"></i>Utilisateurs</a>
                        </li>
                        <li>
                            <a href="{{ route('Camp') }}">
                                <i class="fas fa-leaf"></i>Camp penal</a>
                        </li>
                        <li>
                            <a href="{{ route('Carte') }}">
                                <i class="fas fa-map-marker-alt"></i>Carte</a>
                        </li>
                        <li>
                            <a href="{{ route('Situation') }}">
                                <i class="fas fa-list-alt"></i>Situation judiciaire </a>
                        </li>
{{--                        <li>--}}
{{--                            <a href="{{ route('Culture') }}">--}}
{{--                                <i class="fab fa-pagelines"></i>Liste des cultures</a>--}}
{{--                        </li>--}}

                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END HEADER DESKTOP-->

        <!-- BREADCRUMB-->
        <!-- MAIN CONTENT-->
        <div class="main-content">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
        <!-- END MAIN CONTENT-->
        <!-- END BREADCRUMB-->
    </div>
</div>
</body>
</div>

<!-- Jquery JS-->
<script src="{{ asset('assets/vendor/jquery-3.2.1.min.js') }}"></script>
<!-- Bootstrap JS-->
<script src="{{ asset('assets/vendor/bootstrap-4.1/popper.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
<!-- Vendor JS       -->
<script src="{{ asset('assets/vendor/slick/slick.min.js') }}">
</script>
<script src="{{ asset('assets/vendor/wow/wow.min.js') }}"></script>
<script src="{{ asset('assets/vendor/animsition/animsition.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}">
</script>
<script src="{{ asset('assets/vendor/counter-up/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('assets/vendor/counter-up/jquery.counterup.min.js') }}">
</script>
<script src="{{ asset('assets/vendor/circle-progress/circle-progress.min.js') }}"></script>
<script src="{{ asset('assets/vendor/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('assets/vendor/chartjs/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/select2/select2.min.js') }}">
</script>
<!-- Main JS-->
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
<script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>


</body>

</html>
<!-- end document-->
