@extends('backend.master')
@section('page-title')
My Leave Applications
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3>My Leave Applications</h3>
    </div>
    <div class="card-body">
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
                    <td class="text-center"><span class="badge {{statusColor($result->status) ?? ''}}">{!! $result->status()->reason ?? 'N/A' !!}</span></td>
                    <td class="text-center">
                        <a href="{{URL::signedRoute('leave.employee.show',['id'=>$result->id])}}" class="btn btn-sm" id="">
                            View
                        </a>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="4" class="text-center">No records found</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('page-js')
    @include('asset-partials.datatable')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.datatable').DataTable();
        });
    </script>
@endsection
