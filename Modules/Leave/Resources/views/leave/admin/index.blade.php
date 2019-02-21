@extends('backend.master')
@section('page-title')
Employees Leave Records
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Employees Leave Records</h3>
        <div class="card-options">
            <a href="{{route('admin.apply.leave')}}" class="btn btn-sm btn-primary">Create Leave For Employee</a>
        </div>
    </div>
    <div class="card-body">
        @include('leave::leave.admin.leave-nav-by-status')
        <div class="table-responsive">
        <table class="table table-striped table-bordered datatable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Applicant</th>
                    <th>Leave Type</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th class="text-center">Total Days</th>
                    <th class="text-center">Application Date</th>
                    <th>Status</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($leaves as $key=>$leave)
                <tr>
                    <td>{{++$key}}</td>
                    <td>{{$leave->user->personalDetail->name ?? 'N/A'}}</td>
                    <th>{{$leave->type->name ?? 'N/A'}}</th>
                    <td>{{$leave->start_date ?? 'N/A'}}</td>
                    <td>{{$leave->end_date ?? 'N/A'}}</td>
                    <td class="text-center">{{$leave->days_taken ?? 'N/A'}}</td>
                    <td class="text-center">{{ $leave->created_at->toDayDateTimeString() ?? 'N/A' }}</td>
                    <td class="text-center"><span class="badge badge-md {{statusColor($leave->status) ?? ''}}">{{ ucwords($leave->status) ?? 'N/A' }}</span></td>
                    <td class="text-center">
                        <a href="{{URL::signedRoute('leave.admin.show',['id'=>$leave->id])}}" class="btn btn-sm text-dark btn-link">View</a>
                        <form action="{{route('leave.user.destroy',['id'=>$leave->id])}}" method="POST" class="leave-record d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm text-danger btn-link">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>            
        </table>
        </div>
    </div>
</div>
<!-- user records -->
@endsection
@section('page-js')
@include('asset-partials.datatable',['buttons'=>true])
<script type="text/javascript">
    $(document).ready(function () {

        var table = $('.datatable').DataTable({
            lengthChange: false,
            pageLength: 7,
            initComplete: function () {
                this.api().columns([1]).every(function () {
                    var column = this;
                    var select = $('<select class="form-control"><option value=""></option></select>')
                        .appendTo($(column.header()).empty())
                        .on('change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
                            column
                                .search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                        });

                    column.data().unique().sort().each(function (d, j) {
                        select.append('<option value="' + d + '">' + d +
                            '</option>')
                    });
                });
            },
            buttons: [{
                    extend: 'excel',
                    text: 'Export to excel',
                    className: 'btn btn-success',
                    filename: '{{$leaves->first()->user->personalDetail->name ?? ""}}\'s Leave Records',
                    exportOptions: {
                        modifier: {
                            page: 'all'
                        },
                        columns: 'th:not(:last-child)'
                    }
                },
                {
                    extend: 'copy',
                    text:'Copy table',
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    }
                },
                {
                    extend: 'pdf',
                    text: 'Export to PDF',
                    filename: '{{$leaves->first()->user->personalDetail->name ?? ""}}\'s Leave Records',
                    exportOptions: {
                        modifier: {
                            page: 'current'
                        },
                        columns: 'th:not(:last-child)'
                    }
                },                
            ]
        });
        table.buttons().container().appendTo('.dataTables_wrapper .col-md-6:eq(0)');

    });    

</script>
@include('components.form.confirmDeleteOnSubmission',['entity'=>'leave-record','action'=>'delete'])
@endsection
