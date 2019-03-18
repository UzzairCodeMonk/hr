@extends('backend.master')
@section('page-title')
Employees
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3>@yield('page-title')</h3>
        <div class="card-options">
            <a href="{{route('user.create')}}" class="btn btn-sm btn-primary">Create New Employee</a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <table class="table table-bordered table-striped datatable" id="">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($results))
                        @foreach($results as $key=>$result)

                        <tr>
                            <td>{{++$key}}</td>
                            <td>
                                <div class="media">
                                    <img class="avatar" src="{{asset($result->personalDetail['avatar']) ?? '' }}" alt="">
                                    <div class="media-body">
                                        <p class="lh-1">{{$result->name ?? 'N/A'}}</p>
                                        <small>{{$result->personalDetail->position->name ?? 'N/A'}}
                                            {{$result->personalDetail->staff_number ?? 'N/A'}}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                {{$result->email ?? 'N/A'}}
                            </td>
                            <td class="text-center">
                                <a href="{{URL::signedRoute('employee.details',['id'=>$result->id])}}" class="btn btn-sm text-dark btn-link"
                                    id="">
                                    View
                                </a>
                                <a href="{{URL::signedRoute('user.edit',['id'=>$result->id])}}" class="btn btn-sm btn-link text-dark"
                                    id="">
                                    Edit
                                </a>
                                @if(!$result->hasRole('Admin'))
                                @if(Auth::id() != $result->id)
                                @can('delete_users')
                                <form class="employee" action="{{route('user.destroy',['id'=>$result->id])}}" method="POST"
                                    style="display:inline !important;">
                                    @csrf
                                    {{method_field('DELETE')}}
                                    <button type="submit" class="btn btn-sm btn-link text-danger">Delete</button>
                                </form>
                                @endcan
                                @endif
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="{{count($columnNames)+2}}" class="text-center">No records found.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>

            </div>
        </div>

    </div>
</div>
@endsection


@section('page-js')
@include('asset-partials.datatable')
<script type="text/javascript">
    $(document).ready(function () {
        $('.datatable').DataTable();
    });

</script>
@include('components.form.confirmDeleteOnSubmission',['entity'=>'employee','action'=>'delete'])
@endsection
