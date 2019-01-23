@if(isset($family))
<form action="{{route('family.update',['id'=>$family->id])}}" method="POST" enctype="multipart/form-data">
    @else
    <form action="{{route('family.store')}}" method="POST" enctype="multipart/form-data">
    @endif
    @csrf
    <div class="dynamic-list w-20">
        @include('profile::partials.family.input')
    </div>
</form>
