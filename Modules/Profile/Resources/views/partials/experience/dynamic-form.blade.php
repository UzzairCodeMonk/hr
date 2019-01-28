@if(isset($expPersonal))
<form action="{{route('experience.update',['id'=>$expPersonal->id])}}" method="POST" enctype="multipart/form-data">
    @else
    <form action="{{route('experience.store')}}" method="POST" enctype="multipart/form-data">
    @endif
    @csrf
    <div class="dynamic-list w-20">
        @include('profile::partials.experience.input')
    </div>
</form>
