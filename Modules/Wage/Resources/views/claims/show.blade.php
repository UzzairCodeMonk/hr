@extends('backend.master')
@section('page-title')
Claim Submission - {{$claim->user->personalDetail->name ?? 'N/A'}}
@endsection
@section('content')
<a href="{{URL::previous()}}" class="btn btn-primary btn-md">Back</a>
<div class="mb-3"></div>
<div class="card">
    <div class="card-header">
        <h3>Claim Submission - {{$claim->user->personalDetail->name ?? 'N/A'}}</h3> 
        <div class="card-options">
            <button type="button" class="btn btn-sm btn-info">{!! $claim->date ?? 'N/A' !!}</button>            
        </div>
    </div>
    <div class="card-body">
        @if(Auth::user()->hasRole('Admin'))
        <form action="{{route('leave.approve.reject',['id'=>$claim->id])}}" method="POST" class="approve-reject">
            @csrf
            @else
            <form>
                @endif
                <!-- identity -->
                <div class="row">
                    <div class="col-4">
                        <div class="row">
                            <div class="col">
  
                            </div>
                        </div>

                    </div>
                    <div class="col-8">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Applicant</label>
                                    <p>{!! $claim->user->personalDetail->name ?? 'N/A' !!}</p>
                                </div>
                            </div>
                            <div class="col">
                                <label for="">Application Date</label>
                                <p>{{Carbon\Carbon::parse($claim->created_at)->toDayDateTimeString() ?? 'N/A'}}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="input-normal">Claim Date</label>
                                    <p>{{$claim->date ?? 'N/A'}}</p>
                                </div>
                            </div>                            
                        </div>
                        <div class="row">                            
                            <div class="col">
                                <div class="form-group">
                                    <label for="input-normal">Remarks</label>
                                    <p>{!! $claim->remarks ?? 'N/A'!!}</p>
                                </div>
                            </div>
                        </div>
                        @if($claim->attachments->count() > 0)
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Attachments</label>
                                    <ul>
                                        @foreach($claim->attachments as $attachment)
                                        <li>
                                            <a href="{{asset($attachment->filepath)}}" target="_blank" download="{{$attachment->filename}}">
                                                {{$attachment->filename}}
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endif
                        @role('Admin')
                        
                        <div class="row">
                            <div class="col">
                                <div class="form-group">

                                </div>
                            </div>
                        </div>
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
                                    <button type="submit" name="approve" class="btn btn-md btn-success approve-btn"><i
                                            class="ti ti-check"></i> Approve</button>
                                    <button type="submit" name="reject" class="btn btn-md btn-danger reject-btn"><i
                                            class="ti ti-close"></i> Reject</button>
                                    <a href="{{URL::previous()}}" class="btn btn-md btn-primary"><i class="ti ti-back-left"></i>
                                        Back</a>
                                </div>
                            </div>
                        </div>
                        
                        @endrole
                    </div>
                </div>
            </form>

    </div>
</div>
@endsection
