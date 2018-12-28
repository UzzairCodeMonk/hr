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

                <table class="table table-bordered table-striped">
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
                                <a href="{{URL::signedRoute('payslip.employee.record',['id'=>$user->id,'month'=>$p->month,'year'=>$p->year])}}" class="btn btn-link btn-secondary btn-sm">View</a>
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
                                {!! Form::selectYear('year',2018,2025,null,['id'=>'year','class'=>'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Basic Salary</label>
                                <input type="text" class="form-control" name="basic_salary">
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
                                <input type="text" class="form-control" name="epf_employer">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">EPF Contribution (Employee)</label>
                                <input type="text" class="form-control" name="epf_employee">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">SOCSO Contribution (Employer)</label>
                                <input type="text" class="form-control" name="socso_employer">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">SOCSO Contribution (Employee)</label>
                                <input type="text" class="form-control" name="socso_employee">
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
@include('components.form.confirmDeleteOnSubmission',['entity'=>'leaveType','action'=>'delete'])
@endsection
