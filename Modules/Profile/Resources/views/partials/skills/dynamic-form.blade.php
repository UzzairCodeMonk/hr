@if(isset($skill))
<form action="{{route('skill.updaate',['id'=>$skill->id])}}" method="POST" enctype="multipart/form-data">
    @else
    <form action="{{route('skill.store')}}" method="POST" enctype="multipart/form-data">
    @endif
    @csrf
    <div class="dynamic-list w-20">
        @include('profile::partials.skills.input')
    </div>
</form>
