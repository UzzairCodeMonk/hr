@extends('backend.master')
@section('page-title')
Claim Submission Records
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="cad-title">Claim Submission Records</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-striped table-bordered datatable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Submitter</th>
                    <th>Type</th>
                    <th>Claim Date</th>
                    <th>Remarks</th>                                                           
                    <th class="text-center">Application Date</th>                  
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($claims as $key=>$claim)
                <tr>
                    <td>{{++$key}}</td>
                    <td>{{$claim->user->personalDetail->name ?? 'N/A'}}</td>
                    <th>{{$claim->type->name ?? 'N/A'}}</th>
                    <td>{{$claim->date ?? 'N/A'}}</td>
                    <td>{!! $claim->remarks ?? 'N/A' !!}</td>                   
                    <td class="text-center">{{ $claim->created_at->toDayDateTimeString() ?? 'N/A' }}</td>
                    <td class="text-center">
                        <a href="" class="btn btn-sm text-dark btn-link">View</a>
                        <form action="{{route('claim.destroy',['id'=>$claim->id])}}" method="POST" class="claim-record d-inline">
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
                    filename: '{{$claims->first()->user->personalDetail->name ?? ""}}\'s claim Records',
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
                    filename: '{{$claims->first()->user->personalDetail->name ?? ""}}\'s claim Records',
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
@include('components.form.confirmDeleteOnSubmission',['entity'=>'claim-record','action'=>'delete'])
@endsection
