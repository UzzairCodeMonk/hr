@extends('backend.master')
@section('page-title')
Claim Form
@endsection
@section('page-css')
<style>
    .preloader {
        display: none !important;
    }
</style>
@endsection
@section('content')
<a href="{{URL::previous()}}" class="btn btn-primary">Back</a>
<div class="card">
    <div class="card-header">
        <h3>Claim Subject: {!! $claim->subject ?? 'N/A' !!}</h3>
        <div class="card-options">
            @if(Auth::user()->hasRole('User') && !Auth::user()->hasRole('Admin'))
            @foreach($claim->statuses as $status)
            @if($status->name == 'remarks')
            <form action="{{route('claim.submit')}}" method="POST" class="">
                @csrf
                <input type="hidden" name="claim_id" value="{{$claim->id}}">
                <button type="submit" class="btn btn-primary btn-sm">Submit This Claim</button>
            </form>
            @endif
            @endforeach
            @endif
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="">Claim Status</label>
                    <ol class="timeline timeline-activity timeline-point-sm timeline-content-right w-100 py-20 pr-20">
                        @foreach($claim->statuses as $status)
                        <li class="timeline-block">
                            <div class="timeline-point">
                                <span class="badge badge-dot badge-lg {{statusColor($status['name']) ?? ''}}"></span>
                            </div>
                            <div class="timeline-content">
                                <time datetime="">{{Carbon\Carbon::parse($status['created_at'])->toDayDateTimeString()}}</time>
                                <p>{!!$status->reason!!}</p>
                            </div>
                        </li>
                        @endforeach
                    </ol>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Claim Records
                        </h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered datatable">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>Type</td>
                                    <td>Date</td>
                                    <td>Amount</td>
                                    <td>Remarks</td>
                                    <td>Attachments</td>
                                    @if(Auth::user()->hasRole('User') && !Auth::user()->hasRole('Admin'))
                                    @foreach($claim->statuses as $status)
                                    @if($status->name == 'remarks')
                                    <td>Action</td>
                                    @endif
                                    @endforeach
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($claim->details as $key => $detail)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{!!$detail->type->name ?? 'N/A'!!}</td>
                                    <td>{{$detail->date ?? 'N/A'}}</td>
                                    <td>{{$detail->amount ?? 0.00}}</td>
                                    <td>{!! $detail->remarks ?? 'N/A' !!}</td>
                                    <td>
                                        <ul>
                                            @if($detail->attachments->count() > 0)
                                            @foreach($detail->attachments as $attachment)
                                            <li>
                                                <a href="{{url($attachment->filepath) ?? ''}}" target="_blank">
                                                    {{ $attachment->filename }}
                                                </a>
                                            </li>
                                            @endforeach
                                            @else
                                            <li> No attachments available.</li>
                                            @endif
                                        </ul>
                                    </td>
                                    @if(Auth::user()->hasRole('User') && !Auth::user()->hasRole('Admin'))
                                    @foreach($claim->statuses as $status)
                                    @if($status->name == 'remarks')
                                    <td class="text-center">
                                        <a href="{{route('claimdetail.edit',['id'=>$detail->id])}}" class="btn btn-sm text-dark btn-link">Edit</a>
                                        <form action="{{route('claimdetail.deletedetail',['id'=>$detail->id])}}" method="POST" class="deleteconfirm{{$detail->id}} d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm text-danger btn-link" onclick="deletedetail({{$detail->id}})">Delete</button>
                                        </form>
                                    </td>
                                    @endif
                                    @endforeach
                                    @endif
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="5" class="text-right">Total</td>
                                    @if(Auth::user()->hasRole('User') && !Auth::user()->hasRole('Admin'))
                                    @foreach($claim->statuses as $status)
                                    @if($status->name == 'remarks')
                                    <td>MYR &nbsp;<a class="updatetotal"></a></td>
                                    <td></td>
                                    @endif
                                    @endforeach
                                    @elseif(Auth::user()->hasRole('User') && Auth::user()->hasRole('Admin'))
                                    <td>MYR {{$claim->amount ?? 0.00}}</td>
                                    @else
                                    <td>MYR {{$claim->amount ?? 0.00}}</td>
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col"></div>
            <div class="col">
                @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Approver'))
                @if($actionVisibility)
                <form action="{{route('claim.approval.store')}}" method="POST" class="approve-reject">
                    <input type="hidden" name="claim_id" value="{{$claim->id}}">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Admin Remarks</label>
                                <textarea name="admin_remarks" id="" cols="30" rows="6" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group pull-right">
                                @if($ss == false)
                                <button type="submit" name="remarks" class="btn btn-md btn-primary remarks-btn">
                                    Submit
                                    Remarks Only</button>
                                @endif
                                @can('approve_claim')
                                <button type="submit" name="approve" class="btn btn-md btn-success approve-btn"><i class="ti ti-check"></i>
                                    Approve</button>
                                @endcan
                                @can('reject_claim')
                                <button type="submit" name="reject" class="btn btn-md btn-danger reject-btn"><i class="ti ti-close"></i>
                                    Reject</button>
                                @endcan
                            </div>
                        </div>
                    </div>
                </form>
                @endif
                @endif
            </div>

        </div>
    </div>
</div>

<!-- public holiday modal -->
@endsection
@section('page-js')
@include('asset-partials.datatable')
@include('asset-partials.datepicker')
<script type="text/javascript">
    $('.date').datepicker({
        format: "{{config('app.date_format_js')}}",
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.datatable').DataTable();
    });
</script>
<script type="text/javascript">

    // $('#totalupdate').on("click", function () {
        $.ajax({
            url: '{{route('api.claimdetail.updateclaimtotal',['id'=>$claim->id])}}',
            type: "POST",
            // data: id,
            dataType: "json",
            success: function(response){
                console.log(response);
                $(".updatetotal").empty().append(response.total);
            },
          
        });

        function deletedetail(id) {
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
@endsection