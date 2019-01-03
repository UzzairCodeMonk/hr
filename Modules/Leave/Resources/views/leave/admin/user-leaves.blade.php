@extends('backend.master')
@section('page-title')
{{$leaves->first()->user->personalDetail->name ?? ''}}'s Leave Records
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="cad-title">{{$leaves->first()->user->personalDetail->name ?? ''}}'s Leave Records</h3>
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
                    <th class="text-center">Notes</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($leaves as $key=>$leave)
                <tr>
                    <td>{{++$key}}</td>
                    <th>{{$leave->type->name ?? 'N/A'}}</th>
                    <td>{{$leave->start_date ?? 'N/A'}}</td>
                    <td>{{$leave->end_date ?? 'N/A'}}</td>
                    <td class="text-center">{{$leave->days_taken ?? 'N/A'}}</td>
                    <td class="text-center">{!! $leave->notes ?? 'N/A' !!}</td>
                    <td class="text-center"><span class="badge">{{$leave->status()->reason ?? 'N/A'}}</span></td>
                    <td class="text-center">
                        <a href="{{URL::signedRoute('leave.employee.show',['id'=>$leave->id])}}" class="btn btn-sm text-dark d-inline">View</a>
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
