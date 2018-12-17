<div class="card">
    <div class="card-header" role="" id="{{ isset($title) ? str_slug($title) :  'permissionHeading' }}">
        <h4>           
            {{ $title or 'Override Permissions' }} {!! isset($user) ? '<span class="text-danger">(' . $user->getDirectPermissions()->count() . ')</span>' : '' !!}           
        </h4>
        
        {{-- <div class="card-options">
            
            @can('delete_roles')
            @if(!empty($role))
            <form action="{{route('roles.destroy',['id'=> $role->id])}}" method="POST">
            @csrf
            {{method_field('DELETE')}}
            @foreach(Auth::user()->getRoleNames() as $user_role)
                @if($user_role != $role->name)                     
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure want to delete this role?: {{$role->name}}')">Delete</button>
                @endif           
            @endforeach
            </form>
        @endif
            @endcan

        </div> --}}
    </div>
    <div id="" class="card-body" role="">        
            <div class="row">
                @foreach($permissions as $perm)
                    <?php
                        $per_found = null;
                        if( isset($role) ) {
                            $per_found = $role->hasPermissionTo($perm->name);
                        }
                        if( isset($user)) {
                            $per_found = $user->hasDirectPermission($perm->name);
                        }
                    ?>
                    <div class="col-md-3">
                        <div class="checkbox">
                            <label class="{{ str_contains($perm->name, 'delete') ? 'text-danger' : '' }}">
                                {!! Form::checkbox("permissions[]", $perm->name, $per_found, isset($options) ? $options : []) !!} {{ $perm->name }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
    </div>
</div>