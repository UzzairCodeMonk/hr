<form action="{{route('family.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="dynamic-list w-20">
        @include('profile::partials.family.input')
    </div>
    
</form>
