@if(isset($entity))
<form action="{{route('leave-type.update',['id'=>$entity->id])}}" method="POST">
    @else
    <form action="{{route('leave-type.store')}}" method="POST">
        @endif
        @csrf
        <div class="form-group">
            <label for="" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" value="{{old('name',isset($entity->name)?$entity->name:'')}}">
        </div>
        <div class="form-group">
            <label for="" class="form-label">Days</label>
            <input type="text" class="form-control" name="days" value="{{old('description',isset($entity->days)?$entity->days:'')}}">
        </div>
        <div class="form-group pull-right">
            @if(isset($entity) && url()->current() == route('leave-type.edit',['id'=>$entity->id]))
            <a href="{{route('leave-type.index')}}" class="btn btn-secondary text-dark">Cancel</a>
            @endif
            <button type="submit" class="btn btn-primary">{{isset($entity)?'Update':'Create'}}</button>
        </div>
    </form>
