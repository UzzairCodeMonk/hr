@extends('backend.master')
@section('page-title')
Payslip Records
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h4>{{$user->personalDetail->name}}'s Payslip Records</h4>
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col">
                <h4>Payslip Records</h4>
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
                                <a href="{{URL::signedRoute('payslip.employee.record',['id'=>$user->id,'month'=>$p->month,'year'=>$p->year])}}"
                                    class="btn btn-sm text-dark">View</a>
                                @can('delete_payslips')
                                <form action="{{route('payslip.delete',['id'=>$p->id])}}" method="POST" class="d-inline payslip">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm text-danger">
                                        Delete
                                    </button>
                                </form>
                                @endcan
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
            @role('Admin')
            <div class="col">
                <h4>Generate Payslip Record</h4>
                <form action="{{route('payslip.generate')}}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{$user->id}}">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Month</label>
                                {!! Form::selectMonth('month',null,['id'=>'month','class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Year</label>
                                <input class="form-control" type="text" name="year" value="{{Carbon\Carbon::now()->format('Y')}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Basic Salary (current)</label>
                                <input type="text" class="form-control" name="basic_salary" value="{{$basic_salary}}" readonly>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Allowance</label>
                                <input type="text" class="form-control" name="allowance">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">EPF Contribution (Employer)</label>
                                <input type="text" class="form-control" name="epf_employer" value="{{$epf_employer_contrib}}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">EPF Contribution (Employee)</label>
                                <input type="text" class="form-control" name="epf_employee" value="{{$epf_employee_contrib}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">SOCSO Contribution (Employer)</label>
                                <input type="text" class="form-control" name="socso_employer" 
                                value="{{$socso_employer_contrib}}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">SOCSO Contribution (Employee)</label>
                                <input type="text" class="form-control" name="socso_employee"  
                                value="{{$socso_employee_contrib}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">SOCSO Contribution EIS (Employer)</label>
                                <input type="text" class="form-control" name="socso_eis_employer">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">SOCSO Contribution EIS (Employee)</label>
                                <input type="text" class="form-control" name="socso_eis_employee">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">EA Income Tax</label>
                                <input type="text" class="form-control" name="income_tax">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Remarks</label>
                                <textarea name="remarks" id="" cols="30" rows="6" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary pull-right" type="submit">Generate</button>
                    </div>
                </form>
            </div>
            @endrole
        </div>

    </div>
</div>
@endsection
@section('page-js')
@include('components.form.confirmDeleteOnSubmission',['entity'=>'payslip','action'=>'delete'])
@include('asset-partials.datatable')
<script type="text/javascript">
    $(document).ready(function () {
        $('.datatable').DataTable({
            pageLength: 7,
        });
    });

</script>
@endsection
