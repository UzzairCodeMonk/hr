@if(isset($academy))
<form action="{{route('academic.update',['id'=>$academy->id])}}" method="POST" enctype="multipart/form-data">
    @else
    <form action="{{route('academic.store')}}" method="POST" enctype="multipart/form-data">
        @endif
        @csrf
        <div class="dynamic-list w-20">
            @include('profile::partials.academic.input')
        </div>
    </form>
