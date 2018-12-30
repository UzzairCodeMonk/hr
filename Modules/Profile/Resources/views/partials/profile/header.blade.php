<header class="header bg-img" style="background-image: url({{asset('images/bg-profile.png')}})">
    <!-- <div class="col mt-2">
        <button class="btn btn-primary btn-sm opacity pull-right opacity-75" onclick="document.getElementById('fileInput').click();"><i class="ti ti-pencil"></i> Change Background Image</button>
        <input id="fileInput" type="file" style="display:none;" />
    </div> -->

    <div class="header-info h-250px mb-0">
        <div class="media align-items-end">
            @if(!empty(auth()->user()->personalDetail->avatar))
            <img class="avatar avatar-xl avatar-bordered img-fuid" src="{{asset(auth()->user()->personalDetail->avatar)}}">
            @else
            <img class="avatar avatar-xl avatar-bordered" src="https://api.adorable.io/avatars/285/abott@adorable.png">
            @endif
            <div class="media-body">
                <h1 class="text-white"><strong>{{auth()->user()->personalDetail->name ?? ''}}</strong></h1>
                <p class="text-white">{{Auth::user()->personalDetail->position->name ?? ''}}</p>
            </div>
        </div>
    </div>
    <div class="header-action bg-white">
        <nav class="nav">
            <a class="nav-link {{Request::is('profile/personal-details*')?'active':''}}" href="{{route('personal.index')}}">Personal
                Details</a>
            <a class="nav-link {{Request::is('profile/security*')?'active':''}}" href="{{route('security')}}">Security</a>
        </nav>
    </div>
</header>
