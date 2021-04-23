<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{__('main.title')}}</title>
    <link href="css/media_query.css" rel="stylesheet" type="text/css"/>
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
    <link href="css/animate.css" rel="stylesheet" type="text/css"/>
    <link href="css/owl.carousel.css" rel="stylesheet" type="text/css"/>
    <link href="css/owl.theme.default.css" rel="stylesheet" type="text/css"/>
    <!-- Bootstrap CSS -->
    <link href="css/style_1.css" rel="stylesheet" type="text/css"/>

    <link rel="stylesheet" href="/css/front.css">
@yield('css')
    <!-- Modernizr JS -->
    <script src="{{ asset('js/modernizr-3.5.0.min.js') }}"></script>
</head>
<body>
<div class="container-fluid fh5co_header_bg">
    <div class="container">
        <div class="row">
            <div class="col-12 fh5co_mediya_right">
                @if ($currentUser)
                    <a href="{{ route('logout') }}"  onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();" class="color_fff fh5co_mediya_setting  tdc-sign-in">{{__('main.logout')}}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    @if(\App\Role\RoleChecker::check($currentUser,[]))
                    <a href="{{ route('dashboard') }}" class="color_fff fh5co_mediya_setting"><i
                            class="fa fa-lock"></i> {{__('main.administration')}}
                    </a>
                    @endif
                @else
                    <a href="#" class="color_fff fh5co_mediya_setting  tdc-sign-in"><i
                            class="fas fa-sign-in-alt"></i> {{__('main.signin')}}
                    </a>
                    <a href="{{ route('login') }}" class="color_fff fh5co_mediya_setting"><i
                            class="fa fa-user"></i> {{__('main.login')}}
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-3 fh5co_padding_menu">
                <img src="{{ asset('images/logoTdc.png') }}" target="_blank" alt="img" class="fh5co_logo_width"/>
            </div>
            <!-- todo: Rendre parametrable dans les setting back , dont forget footer -->
            <div class="col-12 col-md-9 align-self-center fh5co_mediya_right">
                <div class="text-center d-inline-block">
                    <a href="https://www.youtube.com/channel/UCPGqSC4lMaa3SVsVhMddX3Q" target="_blank"
                       class="fh5co_display_table"><div class="fh5co_verticle_middle"><i class="fab fa-youtube"></i></div></a>
                </div>
                <div class="text-center d-inline-block">
                    <a href="https://www.twitch.tv/tourdecommandement" target="_blank" class="fh5co_display_table"><div class="fh5co_verticle_middle"><i class="fab fa-twitch"></i></div></a>
                </div>
                <div class="text-center d-inline-block">
                    <a href="https://www.instagram.com/tourdecommandement/" target="_blank" class="fh5co_display_table"><div class="fh5co_verticle_middle"><i class="fab fa-instagram"></i></div></a>
                </div>
                <div class="text-center d-inline-block">
                    <a href="https://twitter.com/tourdecomm" target="_blank" class="fh5co_display_table"><div class="fh5co_verticle_middle"><i class="fab fa-twitter"></i></div></a>
                </div>
                <div class="text-center d-inline-block">
                    <a href="https://www.facebook.com/TourDeCommandement/" target="_blank" class="fh5co_display_table"><div class="fh5co_verticle_middle"><i class="fab fa-facebook"></i></div></a>
                </div>
                <div class="text-center d-inline-block">
                    <a href="https://discord.gg/bYmN4Fm" target="_blank" class="fh5co_display_table"><div class="fh5co_verticle_middle"><i class="fab fa-discord"></i></div></a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid bg-faded fh5co_padd_mediya padding_786">
    <div class="container padding_786">
        <nav class="navbar navbar-toggleable-md navbar-light ">
            <button class="navbar-toggler navbar-toggler-right mt-3" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation"><span class="fa fa-bars"></span></button>
            <a class="navbar-brand" href="#"><img src="{{ asset('images/logoTdc.png') }}" alt="img" class="mobile_logo_width"/></a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="{{ route('who-we-are') }}">{{ __('home.whoWeAre') }}<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="#">{{ __('home.ourArticles') }}<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="#">{{ __('home.commanderGuide') }}<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="#">{{ __('home.decksEvaluation') }}<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="#">{{ __('home.tourWeekend') }}<span class="sr-only">(current)</span></a>
                    </li>
{{--                    <li class="nav-item dropdown">--}}
{{--                        <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuButton2" data-toggle="dropdown"--}}
{{--                           aria-haspopup="true" aria-expanded="false">World <span class="sr-only">(current)</span></a>--}}
{{--                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink_1">--}}
{{--                            <a class="dropdown-item" href="#">Action in</a>--}}
{{--                            <a class="dropdown-item" href="#">Another action</a>--}}
{{--                            <a class="dropdown-item" href="#">Something else here</a>--}}
{{--                        </div>--}}
{{--                    </li>--}}
                </ul>
            </div>
        </nav>
    </div>
</div>
@yield('content')
<div class="container-fluid fh5co_footer_bg pb-3">
    <div class="container animate-box">
        <div class="row">
            <div class="col-12 spdp_right py-5"><img src="{{ asset('images/logoTdc.png') }}" alt="img" class="footer_logo"/></div>
            <div class="clearfix"></div>
            <div class="col-12 col-md-12 col-lg-6">
                <div class="footer_main_title py-3"> {{ __('main.footer.aboutTitle') }}</div>
                <div class="footer_sub_about pb-3">{{ __('main.footer.aboutContent') }}</div>
                <div class="footer_mediya_icon">
                    <div class="text-center d-inline-block">
                        <a href="https://www.youtube.com/channel/UCPGqSC4lMaa3SVsVhMddX3Q" target="_blank"
                           class="fh5co_display_table_footer"><div class="fh5co_verticle_middle"><i class="fab fa-youtube"></i></div>
                        </a>
                    </div>
                    <div class="text-center d-inline-block">
                        <a href="https://www.twitch.tv/tourdecommandement" target="_blank" class="fh5co_display_table_footer"><div class="fh5co_verticle_middle"><i class="fab fa-twitch"></i></div></a>
                    </div>
                    <div class="text-center d-inline-block">
                        <a href="https://www.instagram.com/tourdecommandement/" target="_blank" class="fh5co_display_table_footer"><div class="fh5co_verticle_middle"><i class="fab fa-instagram"></i></div></a>
                    </div>
                    <div class="text-center d-inline-block">
                        <a href="https://twitter.com/tourdecomm" target="_blank" class="fh5co_display_table_footer"><div class="fh5co_verticle_middle"><i class="fab fa-twitter"></i></div></a>
                    </div>
                    <div class="text-center d-inline-block">
                        <a href="https://www.facebook.com/TourDeCommandement/" target="_blank" class="fh5co_display_table_footer">
                            <div class="fh5co_verticle_middle"><i class="fab fa-facebook"></i></div></a>
                    </div>
                    <div class="text-center d-inline-block">
                        <a href="https://discord.gg/bYmN4Fm" target="_blank"
                           class="fh5co_display_table_footer">
                            <div class="fh5co_verticle_middle"><i class="fab fa-discord"></i></div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid fh5co_footer_right_reserved">
    <div class="container">
        <div class="row  ">
            <div class="col-12 col-md-6 py-4 Reserved"> © Copyright 2021, All rights reserved. Design by <a href="{{ route('home') }}">La Tour De Commandement</a> | <a href="https://freehtml5.co">FreeHTML5.co</a>. </div>
        </div>
    </div>
</div>

<div class="gototop js-top">
    <a href="#" class="js-gotop"><i class="fa fa-arrow-up"></i></a>
</div>

<script src="{{ asset('https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js') }}"></script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<!--<script src="{{ asset('https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n') }}" crossorigin="anonymous"></script>-->
<script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js') }}"
        integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb"
        crossorigin="anonymous"></script>
<script src="{{ asset('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js') }}"
        integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn"
        crossorigin="anonymous"></script>
<!-- Waypoints -->
<script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
<!-- Main -->
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/front.js') }}"></script>
@yield('js')

</body>
</html>
