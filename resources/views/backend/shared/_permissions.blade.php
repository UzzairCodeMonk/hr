<div class="card">
    <div class="card-header" role="" id="{{ isset($title) ? str_slug($title) :  'permissionHeading' }}">
        <h4>
            {{ $title ?: 'Override Permissions' }} {!! isset($user) ? '<span class="text-danger">(' .
                $user->getDirectPermissions()->count() . ')</span>' : '' !!}
        </h4>

        <div class="card-options">
            @can('delete_roles')
            @if(!empty($role))
            <form action="{{route('roles.destroy',['id'=> $role->id])}}" method="POST" class="role-delete">
                @csrf
                {{method_field('DELETE')}}
                @foreach(Auth::user()->getRoleNames() as $user_role)
                @if($user_role != $role->name)
                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                @endif
                @endforeach
            </form>
            @endif
            @endcan
        </div>
    </div>
    <form action="{{route('roles.update',['id'=>$role->id])}}" method="POST">
        @csrf
        {{method_field('PUT')}}
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
                    <div class="form-group">
                        <div class="checkbox">
                            <label class="{{ str_contains($perm->name, 'delete') ? 'text-danger' : '' }}">

                                <input type="checkbox" name="permissions[]" id="" value="{{$perm->name}}"
                                    {{ isset($per_found) && $per_found == $perm->name ? 'checked':''}}> {{$perm->name}}
                            </label>
                        </div>
                    </div>
                </div>
                @endforeach
                @can('edit_roles')
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
                @endcan
            </div>
        </div>
    </form>
</div>
