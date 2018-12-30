@extends('backend.master')
@section('page-title')
Employee Records
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
                    <th class="text-center">Action</th>                 
                </tr>
            </thead>
            <tbody>
                @foreach($users as $key=>$user)
                <tr>
                    <td>{{++$key}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>                    
                    <td class="text-center">
                        <a href="{{URL::signedRoute('payslip.show',['id'=>$user->id])}}" class="btn btn-sm text-dark">View</a>      
                        <!-- <a href="{{route('leave.export.excel',['id'=>$user->id])}}" class="btn btn-link btn-success btn-xs text-white">Export To Excel</a>     -->
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
