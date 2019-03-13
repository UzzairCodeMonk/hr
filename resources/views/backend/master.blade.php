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
    
</head>

<body class="sidebar-folded">
    <div class="preloader">
        <div class="spinner-circle-shadow spinner-primary"></div>
    </div>
    @include('backend.partials.sidebar')
    @include('backend.partials.top-bar')
    <main class="main-container">

        @role('Admin')
        @if(Request::is('administration*'))
        @include('backend.partials.admin-sidebar')
        @endif
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

    @include('sweetalert::alert')
    @yield('page-js')
    <script type="text/javascript">
        var now = new Date();
        var hrs = now.getHours();
        var msg = "";
        var icon;
        var img;
        if (hrs > 0) msg = "Good night!", icon = "{!! asset('images/moon.svg')!!}";
        if (hrs > 6) msg = "Good morning", icon = "{!! asset('images/sunny.svg')!!}";
        if (hrs > 12) msg = "Good afternoon", icon = "{!! asset('images/sunny.svg')!!}";
        if (hrs > 17) msg = "Good evening", icon = "{!! asset('images/sunrise.svg')!!}";
        if (hrs > 22) msg = "Go to bed!", icon = "{!! asset('images/moon.svg')!!}";
        @if(Auth::user())
        document.getElementById('greeting').append(msg + " {!! Auth::user()->name !!}");
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
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script type="text/javascript">
        var vueNotifications = new Vue({
            el: '#vue-notifications',
            data: {
                results: null,
                arraysize: '',
                timer: '',
            },
            created: function () {
                this.fetchNotifications();
                this.timer = setInterval(this.fetchNotifications, 15000);
                this.redirect();
            },
            methods: {
                fetchNotifications: function () {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('personal.notifications') }}",
                        type: "GET",
                        success: function (results) {
                            // console.log(results);
                            vueNotifications.results = results;
                            vueNotifications.arraysize = results.length;
                        },
                        error: function () {
                            // alert("Error get notifications");
                            console.log('error get notifications');
                        }
                    });
                },
                redirect: function (id, url) {
                    //console.log(id);
                    data = {
                        id: id,
                    }
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{route('notification.read')}}",
                        type: "POST",
                        data: data,
                        success: function (results) {
                            //console.log("redirect: " + results)
                            location.href = url
                        },
                        error: function () {
                            // alert("Error get notifications");
                            console.log('Error update notifications');
                        }
                    });
                    //location.href = this.url
                }
                //end methods
            }
        });

    </script>        
</body>

</html>
