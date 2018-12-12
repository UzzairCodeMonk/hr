<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/themify-icons/0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="{{asset('css/core.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>

<body class="sidebar-folded">
    @include('backend.partials.sidebar')
    @include('backend.partials.top-bar')
    <main class="main-container">
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
</body>

</html>
