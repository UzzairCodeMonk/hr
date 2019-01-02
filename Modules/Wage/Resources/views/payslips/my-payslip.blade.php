@extends('backend.master')
@section('page-title')
Payslip Records
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h4>My Payslip Records</h4>       
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col">
                <table class="table table-bordered table-striped datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Month</th>
                            <th>Year</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($payslip->count() > 0)
                        @foreach($payslip as $key=>$p)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{getMonthNameBasedOnInt($p->month)}}</td>
                            <td>{{$p->year}}</td>
                            <td class="text-center">
                                <a href="{{URL::signedRoute('payslip.my.record',['id'=>$user->id,'month'=>$p->month,'year'=>$p->year])}}"
                                    class="btn btn-sm text-dark">View</a>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="4" class="text-center">No payslip record found</td>
                        </tr>
                        @endif
                    </tbody>
                </table>

            </div>
        </div>

    </div>
</div>
@endsection
@section('page-js')
@include('components.form.confirmDeleteOnSubmission',['entity'=>'leaveType','action'=>'delete'])
@include('asset-partials.datatable')
<script type="text/javascript">
    $(document).ready(function () {
        $('.datatable').DataTable({
            pageLength: 7,
        });
    });

</script>
@endsection
