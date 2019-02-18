@extends('backend.master')
@section('page-title')
My Leave Applications
@endsection
@section('page-css')
<style>
    .preloader{
        display: none !important;
    }
</style>
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3>My Leave Applications</h3>
    </div>
    <div class="card-body">
        @include('leave::leave.user.leave-nav-by-status')
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="active" role="tabpanel" aria-labelledby="active-tab">
                <div class="table-responsive">
                    <table class="table table-bordered datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Type</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th class="text-center">Total Days</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($results) && $results->count() > 0)
                            @foreach($results as $key=>$result)
                            <tr>
                                <td>{{++$key}}</td>
                                <td>{{$result->type->name ?? 'N/A'}}</td>
                                <td>{{$result->start_date ?? 'N/A'}}</td>
                                <td>{{$result->end_date ?? 'N/A'}}</td>
                                <td class="text-center">{{$result->days_taken ?? 'N/A'}}</td>
                                <td class="text-center"><span class="badge badge-md {{statusColor($result->status) ?? ''}}">
                                        {{ ucwords($result->status ?? 'Missing Status') }}</span></td>
                                <td class="text-center">
                                    <a href="{{URL::signedRoute('leave.show.withdrawn',['id'=>$result->id])}}" class="btn btn-sm"
                                        id="">
                                        View
                                    </a>                                  
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="7" class="text-center">No records found</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

            </div>            
        </div>

    </div>
</div>
@endsection

@section('page-js')
@include('asset-partials.datatable')
@include('components.form.confirmDeleteOnSubmission',['entity'=>'delete-user-leave'])
<script type="text/javascript">
    $(document).ready(function () {
        $('.datatable').DataTable();
    });

</script>
@endsection
