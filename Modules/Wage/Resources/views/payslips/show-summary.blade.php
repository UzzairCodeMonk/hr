@extends('backend.master')

@section('content')
<div class="card">
    <div class="card-header">

    </div>
    <div class="card-body">
        <table class="table table-bordered table-condensed">
            <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Basic Salary (MYR)</th>
                    <th>Allowance  (MYR)</th>
                    <th class="bg-dark">EPF Employer (MYR)</th>
                    <th>EPF Employee (MYR)</th>
                    <th class="bg-dark">SOCSO Employer (MYR)</th>
                    <th>SOCSO Employee (MYR)</th>
                    <th class="bg-dark">EIS Employer (MYR)</th>
                    <th>EIS Employee (MYR)</th>
                    <th>Total Net Salary (MYR)</th>
                    <th>Bank Account No. (MYR)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payslips as $key=>$payslip)
                <tr>
                    <td>{{++$key}}</td>
                    <td>{{$payslip->user->name ?? 0.00}}</td>
                    <td>{{$payslip->basic_salary ?? 0.00}}</td>
                    <td>{{$payslip->allowance ?? 0.00}}</td>
                    <td>{{$payslip->epf_employer ?? 0.00}}</td>
                    <td>{{$payslip->epf_employee ?? 0.00}}</td>
                    <td>{{$payslip->socso_employer ?? 0.00}}</td>
                    <td>{{$payslip->socso_employee ?? 0.00}}</td>
                    <td>{{$payslip->socso_eis_employer ?? 0.00}}</td>
                    <td>{{$payslip->socso_eis_employee ?? 0.00}}</td>
                    <td>{{$payslip->net_wage ?? 0.00}}</td>
                    <td>{{$payslip->user->personalDetail->bank->name ?? 0.00}} {{$payslip->user->personalDetail->bank_account_number ?? 0.00}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
