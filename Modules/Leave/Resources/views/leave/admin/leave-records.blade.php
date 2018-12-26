@extends('backend.master')
@section('page-title')
Employee Leave Records
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
                    <th>Applicant</th>
                    <th>Email</th>
                    <th>Leave Type</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($leaves as $key=>$leave)
                <tr>
                    <td>{{++$key}}</td>
                    <td>{{$leave->user->name}}</td>
                    <td>{{$leave->user->email}}</td>
                    <th>{{$leave->type->name}}</th>
                    <td>{{$leave->start_date}}</td>
                    <td>{{$leave->end_date}}</td>
                    <td style="">
                        <a href="{{URL::signedRoute('leave.show',['id'=>$leave->id])}}" class="btn btn-link btn-secondary btn-xs text-dark">View</a>
                        <form action="{{route('leave.destroy',['id'=>$leave->id])}}" method="POST" class="form-inline leave-record">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-xs btn-link btn-danger text-white">Delete</button>
                        </form>
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
@include('components.form.confirmDeleteOnSubmission',['entity'=>'leave-record','action'=>'delete'])
@endsection
