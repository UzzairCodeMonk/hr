<style>
    .avatar-upload .avatar-edit {
        position: absolute;
    left: 180px;
    z-index: 1;
    top: 100px;
}
.avatar-upload .avatar-edit input {
  display: none;
}
.avatar-upload .avatar-edit input + label {
  display: inline-block;
  width: 34px;
  height: 34px;
  margin-bottom: 0;
  border-radius: 100%;
  background: #FFFFFF;
  border: 1px solid transparent;
  box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
  cursor: pointer;
  font-weight: normal;
  transition: all 0.2s ease-in-out;
}
.avatar-upload .avatar-edit input + label:hover {
  background: #f1f1f1;
  border-color: #d6d6d6;
}
.avatar-upload .avatar-edit input + label:after {
  content: "\e61c";
  font-family: 'themify' !important;
  color: #757575;
  position: absolute;
  top: 7px;
  left: 0;
  right: 0;
  text-align: center;
  margin: auto;
}
.avatar-upload .avatar-preview {
  width: 180px;
  height: 180px;
  /* position: relative; */
  border-radius: 100%;
  border: 6px solid #F8F8F8;
  box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
  top:40px;
}
.avatar-upload .avatar-preview > div {
  width: 100%;
  height: 100%;
  border-radius: 100%;
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center;
}
</style>
<header class="header bg-img" style="background-image: url({{asset('images/bg-profile.svg')}})">
    <!-- <div class="col mt-2">
        <button class="btn btn-primary btn-sm opacity pull-right opacity-75" onclick="document.getElementById('fileInput').click();"><i class="ti ti-pencil"></i> Change Background Image</button>
        <input id="fileInput" type="file" style="display:none;" />
    </div> -->

    <div class="header-info h-250px mb-0">
        <div class="media align-items-end">
            <div class="avatar-upload">
                <div class="avatar-edit" data-provide="tooltip" data-placement="bottom" title="" data-original-title="Change profile picture">                   
                    <input type='file' id="file-upload" accept=".png, .jpg, .jpeg" />
                    <label for="file-upload"></label>
                </div>
                <div class="avatar-preview">
                    <div id="imagePreview" style="background-image: 
                    @if(!empty(auth()->user()->personalDetail->avatar))
                    {{"url(".asset(auth()->user()->personalDetail->avatar).")"}}
                    @else
                        url(https://api.adorable.io/avatars/285/abott@adorable.png)
                    @endif
                    ">
                    </div>
                </div>
            </div>
            <div class="media-body">
                <h1 class="text-white"><strong>{{auth()->user()->personalDetail->name ?? ''}}</strong></h1>
                <p class="text-white">{{Auth::user()->personalDetail->position->name ?? ''}}</p>
            </div>
        </div>
        
        <!-- <div class="media align-items-end">
            @if(!empty(auth()->user()->personalDetail->avatar))
            <img class="" src="{{asset(auth()->user()->personalDetail->avatar)}}" style="vertical-align: middle;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 3px solid #ffffff">
            @else
            <img class="avatar avatar-xl avatar-bordered" src="https://api.adorable.io/avatars/285/abott@adorable.png">
            @endif
            <div class="media-body">
                <h1 class="text-white"><strong>{{auth()->user()->personalDetail->name ?? ''}}</strong></h1>
                <p class="text-white">{{Auth::user()->personalDetail->position->name ?? ''}}</p>
            </div>
        </div> -->
    </div>
    <div class="header-action bg-white">
        <nav class="nav">
            <a class="nav-link {{Request::is('in-profile-modules/in-personal-details*')?'active':''}}" href="{{route('personal.index')}}">Personal
                Details</a>
            <a class="nav-link {{Request::is('in-profile-modules/security*')?'active':''}}" href="{{route('security')}}">Security</a>
        </nav>
    </div>
</header>
