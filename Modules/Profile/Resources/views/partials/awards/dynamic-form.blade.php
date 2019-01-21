<form action="{{route('award.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="dynamic-list w-20">
        @include('profile::partials.awards.input')
    </div>    
</form>
