<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href='https://fonts.googleapis.com/css?family=Roboto:400,500,400italic,300italic,300,500italic,700,700italic,900,900italic'
        rel='stylesheet' type='text/css'>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS"
        crossorigin="anonymous">
    <!-- FontAwesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.1.0/js/all.js" integrity="sha384-3LK/3kTpDE/Pkp8gTNp2gR/2gOiwQ6QaO7Td0zV76UFJVhqLl4Vl3KL1We6q6wR9"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('css/resume.css')}}">
</head>

<body>
    <div class="wrapper">
        <div class="sidebar-wrapper">
            <div class="profile-container">
                <img class="profile" src="{{!empty($personalDetail->avatar) ? asset($personalDetail->avatar):''}}" alt="" width="150px"/>
                <h1 class="name">{{$personalDetail->name ?? 'N/A'}}</h1>
                <h3 class="tagline">{{$personalDetail->position->name ?? 'N/A'}}</h3>
            </div>
            <!--//profile-container-->

            <div class="contact-container container-block">
                <ul class="list-unstyled contact-list">
                    <li class="email"><i class="fas fa-envelope"></i><a href="mailto:" .{!! $personalDetail->user->email
                            !!}>{{$personalDetail->user->email}}</a></li>
                    <li class="phone"><i class="fas fa-phone"></i><a href="">{{$personalDetail->mobile_number?:'N/A'}}</a></li>                   
                </ul>
            </div>
            <!--//contact-container-->
            @if($academics->count() > 0)
            <div class="education-container container-block">
                <h2 class="container-block-title">Education</h2>
                @foreach($academics as $academic)
                <div class="item">
                    <h4 class="degree">{{$academic->course ?? 'N/A'}}</h4>
                    <h5 class="meta">{{$academic->study_level ?? 'N/A'}}</h5>
                    <h5 class="meta">{{$academic->institution ?? 'N/A'}}</h5>
                    <div class="time">{{Carbon\Carbon::parse($academic->start_date)->format('Y') ?? 'N/A'}} -
                        {{Carbon\Carbon::parse($academic->end_date)->format('Y') ?? 'N/A'}} </div>
                </div>
                @endforeach
                <!--//item-->
            </div>
            @endif
            <!--//education-container-->

        </div>
        <!--//sidebar-wrapper-->

        <div class="main-wrapper">

            <!-- <section class="section summary-section">
                <h2 class="section-title"><span class="icon-holder"><i class="fas fa-user"></i></span>Career Profile</h2>
                <div class="summary">
                    <p>Summarise your career here lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget
                        dolor aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur
                        ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu.</p>
                </div>                
            </section> -->
            <!--//section-->
            @if($experience->count() > 0)
            <section class="section experiences-section">
                <h2 class="section-title"><span class="icon-holder"><i class="fas fa-briefcase"></i></span>Experiences</h2>
                @foreach($experience as $exp)
                <div class="item">
                    <div class="meta">
                        <div class="upper-row">
                            <h3 class="job-title">{{$exp->position}}</h3>
                            <div class="time">{{Carbon\Carbon::parse($exp->start_date)->format('Y') ?? 'N/A'}} -
                                {{Carbon\Carbon::parse($exp->end_date)->format('Y') ?? 'N/A'}} </div>
                        </div>
                        <!--//upper-row-->
                        <div class="company">{{$exp->company ?? 'N/A'}}</div>
                    </div>
                    <!--//meta-->
                    <div class="details">
                        {!! $exp->description ?? 'N/A' !!}
                    </div>
                    <!--//details-->
                </div>
                @endforeach
                <!--//item-->
            </section>
            @endif
            <!--//section-->

            @if($skills->count() > 0)
            <section class="skills-section section">
                <h2 class="section-title"><span class="icon-holder"><i class="fas fa-rocket"></i></span>Skills &amp;
                    Proficiency</h2>
                <div class="skillset">
                    @foreach($skills as $skill)
                    <div class="item">
                        <h3 class="level-title">{{$skill->skill}}</h3>
                        <div class="progress level-bar">
                            <div class="progress-bar theme-progress-bar" role="progressbar" 
                            style="width: {{$skill->period}}%" aria-valuenow="{{$skill->period}}" aria-valuemin="0" aria-valuemax="100">{{$skill->period??'N/A'}}%</div>
                        </div>
                    </div>
                    @endforeach
                    <!--//item-->
                </div>
            </section>
            @endif
            <!--//skills-section-->

        </div>
        <!--//main-body-->
    </div>

    <footer class="footer">
        <div class="text-center">            
            <small class="copyright">Datakraf Solutions Sdn. Bhd.</small>
        <!--//container-->
    </footer>
    <!--//footer-->

</body>

</html>
