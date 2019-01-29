@extends('backend.master')
@section('page-title')
    Roles &amp; Permissions
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fe fe-lock"></i> Roles & Permissions</h3>
    </div>
    <div class="card-body">
        <form action="{{route('roles.store')}}" method="POST">
            @csrf
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Create Role</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Role Name</label>
                        <input type="text" class="form-control" name="name">
                        @if ($errors->has('name'))
                        <p class="help-block">{{ $errors->first('name') }}</p>
                        @endif
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>

        </form>
        @forelse ($roles as $role)
        
            @if($role->name === 'Admin')
            @include('backend.shared._permissions', [ 'title' => $role->name .' Permissions', 'options'=> ['disabled'] ])
            @else
            @include('backend.shared._permissions', ['title' => $role->name .' Permissions', 'model' => $role ])
            @endif
       
        @empty
        <p>No Roles defined, please run <code>php artisan db:seed</code> to seed some dummy data.</p>
        @endforelse
    </div>
</div>
@endsection
@section('page-js')
<script type="text/javascript">
    $(".role-delete").on("submit", function () {
        event.preventDefault();
        return swal({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
        }).then((result) => {
            if (result.value) {
                $(".role-delete").submit();
            }
        });
    });
</script>
@endsection
