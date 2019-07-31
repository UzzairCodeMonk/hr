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
        @include('wage::claims.claim-nav-user')
        <div class="table-responsive">
            <table class="table table-striped table-bordered datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Submitter</th>
                        <th>Accumulated Amount (MYR)</th>
                        <th class="text-center">Created At</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($claims as $key=>$claim)
                    <tr>
                        <td>{{++$key}}</td>
                        <!-- <td>{{$claim->subject ?? 'N/A'}}</td> -->
                        <td>{{$claim->user->name ?? 'N/A'}}</td>
                        <td>{{$claim->amount ?? 0.00}}</td>
                        <td class="text-center">{{ $claim->created_at->toDayDateTimeString() ?? 'N/A' }}</td>
                        <td class="text-center"><span class="badge badge-md {{statusColor($claim->status) ?? ''}}">{{ ucwords($claim->status) ?? 'N/A' }}</span></td>
                        <td class="text-center">
                            <a href="{{URL::signedRoute('claimdetail.show',['id'=>$claim->id])}}" class="btn btn-sm text-dark btn-link">View</a>
                            <form action="{{route('claim.destroy',['id'=>$claim->id])}}" method="POST" class="deleteconfirm{{$claim->id}} d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm text-danger btn-link" onclick="deleteclaim({{$claim->id}})">Delete</button>
                            </form>
                            @if($claim->status == 'remarks')
                            <a href="{{URL::signedRoute('claim.editClaim',['id'=>$claim->id])}}" class="btn btn-sm text-dark btn-link">Edit</a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="create-claim-modal" tabindex="-1" role="dialog" aria-labelledby="create-claim-modal" aria-hidden="true">
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
    $(document).ready(function() {

        var table = $('.datatable').DataTable({
            lengthChange: false,
            pageLength: 7,
            initComplete: function() {
                this.api().columns([1]).every(function() {
                    var column = this;
                    var select = $(
                            '<select class="form-control"><option value=""></option></select>'
                        )
                        .appendTo($(column.header()).empty())
                        .on('change', function() {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
                            column
                                .search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                        });

                    column.data().unique().sort().each(function(d, j) {
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

    function deleteclaim(id) {
        event.preventDefault();
        return swal({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
            confirmButtonText: '<i class="ti ti-check"></i> Yes, I\'m sure',
            confirmButtonAriaLabel: 'Thumbs up, great!',
            cancelButtonText: '<i class="ti ti-close"></i> Nope, abort mission',
            cancelButtonAriaLabel: 'Thumbs down',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $(".deleteconfirm" + id).trigger('submit');
            }
        });
    }
</script>
@include('components.form.confirmDeleteOnSubmission',['entity'=>'claim-record','action'=>'delete'])
@endsection