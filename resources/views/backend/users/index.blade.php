@extends('backend.master')
@section('page-title')
Employees
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3>@yield('page-title')</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <table class="table table-bordered table-striped datatable" id="">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($results))
                        @foreach($results as $key=>$result)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>
                                {{$result->name}}
                            </td>
                            <td>
                                {{$result->email}}
                            </td>
                            <td class="text-center">

                                <a href="{{route('employee.details',['id'=>$result->id])}}" class="btn btn-sm btn-link text-dark" id="">
                                    View
                                </a>
                                <form class="employee" action="{{route('user.destroy',['id'=>$result->id])}}" method="POST"
                                    style="display:inline !important;">
                                    @csrf
                                    {{method_field('DELETE')}}
                                    <button type="submit" class="btn btn-link btn-sm btn-danger text-white">Delete</button>
                                </form>

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
