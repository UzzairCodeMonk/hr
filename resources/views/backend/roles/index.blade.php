@extends('backend.master')
@section('content')    
        @card 
        @cardHeader 
            @slot('card_title')<i class="fe fe-lock"></i> Roles & Permissions @endslot 
        @endcardHeader 
            @cardBody 
            {!! Form::open(['method' => 'post']) !!} 
            @formGroup(['form_label'=>'Name'])
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Role Name']) !!} @if ($errors->has('name'))
            <p class="help-block">{{ $errors->first('name') }}</p> @endif 
            @endformGroup 
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!} 
            <div class="mt-5"></div>
            @formGroup(['form_label'=>''])
                @forelse ($roles as $role)              
                {!! Form::model($role, ['method' => 'PUT', 'route' => ['roles.update', $role->id ], 'class' =>
                '']) !!} 
                    @if($role->name === 'Admin')
                        @include('shared._permissions', [ 'title' => $role->name .' Permissions', 'options'=> ['disabled'] ])
                    @else
                        @include('shared._permissions', ['title' => $role->name .' Permissions', 'model' => $role ])                        
                        @can('edit_roles')
                        <div class="form-group">
                            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}                            
                        </div> 
                        @endcan                        
                    @endif 
                {!! Form::close() !!}
                @empty
                <p>No Roles defined, please run <code>php artisan db:seed</code> to seed some dummy data.</p>
                
            @endforelse
            @endformGroup
            @endcardBody 
        @endcard  
@endsection