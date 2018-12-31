@extends('backend.master')
@section('page-title')
{{$leave->user->personalDetail->name}}'s' Leave Records
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="cad-title">{{$leave->user->personalDetail->name}}'s Leave Records</h3>
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
                    <td>{{$leave->user->personalDetail->name}}</td>
                    <td>{{$leave->user->email}}</td>
                    <th>{{$leave->type->name}}</th>
                    <td>{{$leave->start_date}}</td>
                    <td>{{$leave->end_date}}</td>
                    <td class="text-center">
                        <a href="{{URL::signedRoute('leave.show',['id'=>$leave->id])}}" class="btn btn-sm text-dark">View</a>
                        <form action="{{route('leave.destroy',['id'=>$leave->id])}}" method="POST" class="form-inline leave-record">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm text-danger">Delete</button>
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
