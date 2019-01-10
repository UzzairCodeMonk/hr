@extends('backend.master')
@section('page-title')
Employee user Records
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="cad-title">Employees Leave Records</h3>
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered datatable" data-provide="datatables">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th class="text-center">Email</th>   
                    <th class="text-center">Action</th>                 
                </tr>
            </thead>
            <tbody>
                @foreach($users as $key=>$user)
                <tr>
                    <td>{{++$key}}</td>
                    <td>
                        <div class="media">
                            <img class="avatar" src="{{asset($user->personalDetail->avatar) ?? '' }}" alt="">
                            <div class="media-body">
                                <p class="lh-1">{{$user->name ?? 'N/A'}}</p>
                                <small>{{$user->personalDetail->position->name}}</small>
                            </div>
                        </div></td>
                    <td class="text-center">{{$user->email}}</td>                    
                    <td class="text-center">
                        <a href="{{URL::signedRoute('leave.show',['id'=>$user->id])}}" class="btn btn-sm text-dark btn-link">View</a>                                           
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
@include('asset-partials.datatable')
<script type="text/javascript">
    $(document).ready(function () {
        $('.datatable').DataTable();
    });

</script>
@endsection
