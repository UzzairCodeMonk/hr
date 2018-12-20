@if(isset($entity))
<form action="{{route('position.update',['id'=>$entity->id])}}" method="POST">
    @else
    <form action="{{route('position.store')}}" method="POST">
        @endif
        @csrf
        <div class="form-group">
            <label for="" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" value="{{old('name',isset($entity->name)?$entity->name:'')}}">
        </div>
        <div class="form-group">
            <label for="" class="form-label">Description</label>
            <input type="text" class="form-control" name="description" value="{{old('description',isset($entity->description)?$entity->description:'')}}">
        </div>
        <div class="form-group pull-right">            
            @if(isset($entity) && url()->current() == route('position.edit',['id'=>$entity->id]))
                <a href="{{route('position.index')}}" class="btn btn-secondary text-dark">Cancel</a>
            @endif
            <button type="submit" class="btn btn-primary">{{isset($entity)?'Update':'Create'}}</button>
        </div>
    </form>

