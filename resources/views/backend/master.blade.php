<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{env('APP_NAME')}} - @yield('page-title')</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/themify-icons/0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="{{asset('css/core.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    @yield('page-css')
</head>

<body class="sidebar-folded">
    @include('backend.partials.sidebar')
    @include('backend.partials.top-bar')
    <main class="main-container">
        @include('backend.partials.admin-sidebar')
        <div class="main-content">
            @yield('content')
        </div>
        @include('backend.partials.footer')
    </main>
    <script type="text/javascript" src="{{asset('js/core.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/script.js')}}"></script>
    @yield('page-js')
    @include('sweetalert::alert')
    <script type="text/javascript">
        var now = new Date();
        var hrs = now.getHours();
        var msg = "";
        var icon;
        var img;
        if (hrs > 0) msg = "Mornin' Sunshine!",icon="{!! asset('images/moon.svg')!!}"; // REALLY early
        if (hrs > 6) msg = "Good morning",icon="{!! asset('images/sunny.svg')!!}"; // After 6am
        if (hrs > 12) msg = "Good afternoon",icon="{!! asset('images/sunny.svg')!!}"; // After 12pm
        if (hrs > 17) msg = "Good evening",icon="{!! asset('images/sunrise.svg')!!}";
        if (hrs > 22) msg = "Go to bed!",icon="{!! asset('images/moon.svg')!!}"; // After 10pm
        document.getElementById('greeting').append(msg+" {{auth()->user()->name}}");       
       $('#icon').html("<img width='30' src='"+icon+"' />");
    </script>
</body>

</html>
