@if(isset($entity))
<form action="{{route('holiday.update',['id'=>$entity->id])}}" method="POST">
    @else
    <form action="{{route('holiday.store')}}" method="POST">
        @endif
        @csrf
        <div class="form-group">
            <label for="" class="form-label require">Name</label>
            <input type="text" class="form-control" name="name" value="{{old('name',isset($entity->name)?$entity->name:'')}}">
            @include('backend.shared._errors',['entity'=>'name'])
        </div>
        <div class="form-group">
            <label for="" class="form-label require">Date</label>
            <input type="text" class="form-control date" name="date" value="{{old('date',isset($entity->date)?$entity->date:'')}}">
            @include('backend.shared._errors',['entity'=>'date'])
        </div>
        <div class="form-group pull-right">
            @if(isset($entity) && url()->current() == route('holiday.edit',['id'=>$entity->id]))
            <a href="{{route('holiday.index')}}" class="btn btn-secondary text-dark">Cancel</a>
            @endif
            <button type="submit" class="btn btn-primary">{{isset($entity)?'Update':'Create'}}</button>
        </div>
    </form>
