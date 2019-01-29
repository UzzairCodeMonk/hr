<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>HRMS - @yield('page-title')</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/themify-icons/0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="{{asset('css/core.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    @yield('page-css')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style>
        .topbar-btns .topbar-btn.has-new i::after{
        content: "{{ Auth::user()->unreadNotifications->count() ?? 0}}" !important;         
    position: absolute;
    top: -11px;
    right: -7px;
    /* display: inline-block; */
    width: 16px;
    height: 16px;
    border-radius: 50%;
    /* border: 2px solid #fff; */
    background-color: #f96868;
    padding: 0.em;
    font-size: 9px;
    line-height: 11px;
}
    </style>
</head>

<body class="sidebar-folded">
    <!-- <div class="preloader">
        <div class="spinner-circle-shadow spinner-primary"></div>
    </div> -->
    @include('backend.partials.sidebar')
    @include('backend.partials.top-bar')
    <main class="main-container">
        @role('Admin')
        @include('backend.partials.admin-sidebar')
        @endrole
        <div class="main-content">
            @yield('content')
        </div>
        @include('backend.partials.footer')
    </main>
    <script type="text/javascript" src="{{asset('js/core.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/script.js')}}"></script>
    @include('password-strength::asset')
    @yield('page-js')
    @include('sweetalert::alert')
    <script type="text/javascript">
        var now = new Date();
        var hrs = now.getHours();
        var msg = "";
        var icon;
        var img;
        if (hrs > 0) msg = "Mornin'", icon = "{!! asset('images/moon.svg')!!}"; // REALLY early
        if (hrs > 6) msg = "Good morning", icon = "{!! asset('images/sunny.svg')!!}"; // After 6am
        if (hrs > 12) msg = "Good afternoon", icon = "{!! asset('images/sunny.svg')!!}"; // After 12pm
        if (hrs > 17) msg = "Good evening", icon = "{!! asset('images/sunrise.svg')!!}";
        if (hrs > 22) msg = "Go to bed!", icon = "{!! asset('images/moon.svg')!!}"; // After 10pm
        @if(Auth::user())
        document.getElementById('greeting').append(msg + " {{Auth::user()->name}}");
        $('#icon').html("<img width='30' src='" + icon + "' />");
        @endif

    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.mark-read').on('click', function () {
                $('.mark-read').submit();
            });
        });

    </script>

</body>

</html>
