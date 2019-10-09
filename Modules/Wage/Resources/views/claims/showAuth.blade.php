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
            <a href="{{route('pdf-claim',['id'=> $claim->id])}}" class="btn btn-primary btn-sm" id="exportpdf">Export To PDF</a>
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
                                    <td>Category</td>
                                    <td>Date</td>
                                    <td>Amount</td>
                                    <td>Remarks</td>
                                    <td>Attachments</td>
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
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="5" class="text-right">Total</td>
                                    <td>MYR {{$claim->amount ?? 0.00}}</td>
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
@endsection