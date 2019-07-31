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
            <form action="{{route('claim.submit')}}" method="POST" class="">
                @csrf
                <input type="hidden" name="claim_id" value="{{$claim->id}}">
                <button type="submit" class="btn btn-primary btn-sm">Submit This Claim</button>
            </form>
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
                                    <td>Action</td>
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
                                    <td class="text-center">
                                        <a href="{{route('claimdetail.edit',['id'=>$detail->id])}}" class="btn btn-sm text-dark btn-link">Edit</a>
                                        <form action="{{route('claimdetail.deletedetail',['id'=>$detail->id])}}" method="POST" class="deleteconfirm{{$detail->id}} d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm text-danger btn-link" onclick="deletedetail({{$detail->id}})">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="5" class="text-right">Total</td>
                                    <td>MYR &nbsp;<a class="updatetotal"></a></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
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