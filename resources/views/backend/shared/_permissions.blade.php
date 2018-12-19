<div class="card">
    <div class="card-header" role="" id="{{ isset($title) ? str_slug($title) :  'permissionHeading' }}">
        <h4>
            {{ $title ?: 'Override Permissions' }} {!! isset($user) ? '<span class="text-danger">(' .
                $user->getDirectPermissions()->count() . ')</span>' : '' !!}
        </h4>
        <div class="card-options pull-right">
            @can('edit_roles')
            <button type="submit" name="delete-role" class="btn btn-link text-dark">Delete Role</button>
            {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}

            @endcan
        </div>
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
            <div class="col-4">
                <div class="checkbox">
                    <label class="{{ str_contains($perm->name, 'delete') ? 'text-danger' : '' }}">
                        {!! Form::checkbox("permissions[]", $perm->name, $per_found, isset($options) ? $options : [])
                        !!} {{ $perm->name }}
                    </label>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
