@extends('backend.master')
@section('page-title')
Claim Submission Records
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Claim Submission Records</h3>
        <div class="card-options">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#create-claim-modal">
                Create New Claim
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Submitter</th> 
                        <th>Accumulated Amount (MYR)</th>                       
                        <th class="text-center">Created At</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($claims as $key=>$claim)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$claim->subject ?? 'N/A'}}</td>
                        <td>{{$claim->amount ?? 0.00}}</td>
                        <td class="text-center">{{ $claim->created_at->toDayDateTimeString() ?? 'N/A' }}</td>
                        <td class="text-center">
                            <a href="{{URL::signedRoute('claimdetail.show',['id'=>$claim->id])}}" class="btn btn-sm text-dark btn-link">View</a>
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
<div class="modal fade" id="create-claim-modal" tabindex="-1" role="dialog" aria-labelledby="create-claim-modal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create New Claim</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('claim.store')}}" method="POST">
                    <input type="hidden" name="user_id" value="{{auth()->id()}}">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Claim Subject</label>
                                <input type="text" name="subject" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
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
                    var select = $(
                            '<select class="form-control"><option value=""></option></select>'
                        )
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
                    text: 'Copy table',
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
