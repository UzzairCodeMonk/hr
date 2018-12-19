@extends('backend.master')
@section('page-title')
    
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3>Roles & Permissions</h3>
    </div>
    <div class="card-body">
        {!! Form::open(['method' => 'post']) !!}
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Role Name']) !!}
        @if($errors->has('name'))
        <p class="help-block">{{ $errors->first('name') }}</p>
        @endif

        {!! Form::submit('Save', ['class' => 'btn btn-primary mt-3']) !!}
        {!! Form::close() !!}

        @forelse($roles as $role)
        {!! Form::model($role, ['method' => 'PUT', 'route' => ['roles.update', $role->id ], 'class' =>
        '']) !!}
        
        @if($role->name === 'Admin')
        @include('backend.shared._permissions', ['title'=>$role->name.' Permissions', 'options'=> ['disabled'] ])
        @else
        @include('backend.shared._permissions', ['title'=>$role->name.' Permissions', 'model' => $role ])
        
        @endif
        {!! Form::close() !!}
        @empty
        <p>No Roles defined, please run <code>php artisan db:seed</code> to seed some dummy data.</p>
        @endforelse
    </div>
</div>

@endsection
