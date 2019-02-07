@extends('backend.master')
@section('page-title')
Payslip Summary
@endsection
@section('content')
<a href="{{URL::previous()}}" class="btn btn-primary">Back</a>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Payslip Summary - {{getMonthNameBasedOnInt($summary->month) ?? ''}} {{$summary->year ??
            ''}}</h3>
        <div class="card-options">
            <a href="{{route('print.payslip.summary',['month'=>$summary,'year'=>$summary->year])}}" class="btn btn-primary btn-sm" target="_blank">Print</a>
        </div>
    </div>
    <div class="card-body">
      
        <table class="table table-bordered table-condensed">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Basic Salary (MYR)</th>
                    <th>Allowance (MYR)</th>
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
                <tr class="text-center">
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
                    <td>{{$payslip->user->personalDetail->bank->name ?? 0.00}}
                        {{$payslip->user->personalDetail->bank_account_number ?? 0.00}}</td>
                </tr>
                @endforeach
                <tr class="text-center font-weight-bold">
                    <td></td>
                    <td>Total</td>
                    <td>{{number_format($summary->basic_of_month,2,'.','') ?? 0.00}}</td>
                    <td>{{number_format($summary->allowance,2,'.','') ?? 0.00}}</td>
                    <td>{{number_format($summary->epf_employer,2,'.','') ?? 0.00}}</td>
                    <td>{{number_format($summary->epf_employee,2,'.','') ?? 0.00}}</td>
                    <td>{{number_format($summary->socso_employer,2,'.','') ?? 0.00}}</td>
                    <td>{{number_format($summary->socso_employee,2,'.','') ?? 0.00}}</td>
                    <td>{{number_format($summary->eis_employer,2,'.','') ?? 0.00}}</td>
                    <td>{{number_format($summary->eis_employee,2,'.','') ?? 0.00}}</td>
                    <td>{{number_format($summary->net_wage,2,'.','') ?? 0.00}}</td>
                    <td class="bg-dark"></td>
                </tr>
                <tr>
                    <td colspan="12" class="text-right font-weight-bold">
                        <p>
                            Total Employer Expenses :
                             MYR {{number_format($summary->employer_expenses,2,'.','') ?? 0.00}}
                        </p>

                    </td>
                </tr>
            </tbody>
        </table>

    </div>
</div>

@endsection
