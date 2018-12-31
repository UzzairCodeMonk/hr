@extends('backend.master')
@section('page-title')
Leave Records
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="cad-title">{{$leaves->first()->user->personalDetail->name}}'s Leave Records</h3>
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered datatable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Leave Type</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th class="text-center">Total Days</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($leaves as $key=>$leave)
                <tr>
                    <td>{{++$key}}</td>
                    <th>{{$leave->type->name}}</th>
                    <td>{{$leave->start_date}}</td>
                    <td>{{$leave->end_date}}</td>
                    <td class="text-center">{{$leave->days_taken}}</td>
                    <td class="text-center"><span class="badge">{{$leave->status()->reason}}</span></td>
                    <td class="text-center">
                        <a href="{{URL::signedRoute('leave.employee.show',['id'=>$leave->id])}}" class="btn btn-sm text-dark">View</a>
                        <form action="{{route('leave.destroy',['id'=>$leave->id])}}" method="POST" class="leave-record d-inline">
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

        var table = $('.datatable').DataTable({
            lengthChange: false,
            pageLength:7,
            buttons: [{
                extend: 'excel',
                text: 'Export excel',
                className: 'btn btn-success',
                filename: '{{$leaves->first()->user->personalDetail->name}}\'s Leave Records',
                exportOptions: {
                    modifier: {
                        page: 'all'
                    },
                    columns: 'th:not(:last-child)'
                }
            }]
        });
        table.buttons().container().appendTo( '.dataTables_wrapper .col-md-6:eq(0)' );

    });

</script>
@include('components.form.confirmDeleteOnSubmission',['entity'=>'leave-record','action'=>'delete'])
@endsection
