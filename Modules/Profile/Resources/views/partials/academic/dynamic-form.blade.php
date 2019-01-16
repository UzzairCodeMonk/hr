<form action="{{route('academic.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="dynamic-list w-20">
        @include('profile::partials.academic.input')
    </div>
    
</form>
