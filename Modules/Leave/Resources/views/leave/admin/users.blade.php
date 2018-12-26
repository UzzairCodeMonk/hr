@extends('backend.master')
@section('page-title')
Employee user Records
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="cad-title">Employees Leave Records</h3>
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered datatable" data-provide="datatables">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>   
                    <th>Action</th>                 
                </tr>
            </thead>
            <tbody>
                @foreach($users as $key=>$user)
                <tr>
                    <td>{{++$key}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>                    
                    <td>
                        <a href="{{URL::signedRoute('leave.show',['id'=>$user->id])}}" class="btn btn-link btn-secondary btn-xs text-dark">View</a>                        
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- user records -->
@endsection
@section('page-js')
@include('asset-partials.datatable')
<script type="text/javascript">
    $(document).ready(function () {
        $('.datatable').DataTable();
    });

</script>
@endsection
