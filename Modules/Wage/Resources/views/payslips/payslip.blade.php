@extends('backend.master')
@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            {{getMonthNameBasedOnInt($payslip->month)}} {{$payslip->year}} Payslip
        </h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <h6>{{$payslip->user->personalDetail->name}}</h6>
                <table>
                    <tr>
                        <td><strong>Employee #:</strong></td>
                        <td></td>
                        <td>{{$payslip->user->personalDetail->staff_number ?? 'N/A'}}</td>
                    </tr>
                    <tr>
                        <td><strong>Position:</strong></td>
                        <td></td>
                        <td>{{$payslip->user->personalDetail->position->name ?? 'N/A'}}</td>
                    </tr>
                    <tr>
                        <td><strong>Passport/IC No:</strong></td>
                        <td></td>
                        <td>{{$payslip->user->personalDetail->ic_number ?? 'N/A'}} </td>
                    </tr>
                    <tr>
                        <td><strong>Income Tax No:</strong></td>
                        <td></td>
                        <td>{{$payslip->user->personalDetail->income_tax_no ?? 'N/A'}}</td>
                    </tr>
                    <tr>
                        <td><strong>Cost Center:</strong></td>
                        <td></td>
                        <td>Application Development</td>
                    </tr>
                </table>
            </div>
            <div class="col">
                <div class="logo-text pull-right" style="text-align:justify;width:270px">
                    <img src="https://www.datakraf.com/images/logo-footer.png" alt="" style="display:block;margin:0 auto">
                </div>
                <br><br>
                <p class="text-right mt-3">
                    Suite 7-1, Binjai 8, <br>Lorong Binjai Off Jalan Binjai,<br> KLCC, 50450, Kuala Lumpur, Malaysia.
                </p>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" colspan="2">Earnings</th>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <th class="text-right">Amount (MYR)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Basic Salary</td>
                            <td class="text-right">{{$payslip->basic_salary ?? 'N/A'}}</td>
                        </tr>
                        <tr>
                            <td>Allowance</td>
                            <td class="text-right">{{$payslip->allowance ?? 'N/A'}}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-right"><strong>Total: {{$payslip->total_earnings ?? 'N/A'}}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" colspan="2">Employee Contributions</th>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <th class="text-right">This Pay (MYR)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>EPF</td>
                            <td class="text-right">{{$payslip->epf_employee ?? 'N/A'}}</td>
                        </tr>
                        <tr>
                            <td>SOCSO</td>
                            <td class="text-right">{{$payslip->socso_employee ?? 'N/A'}}</td>
                        </tr>
                        <tr>
                            <td>EIS</td>
                            <td class="text-right">{{$payslip->socso_eis_employee ?? 'N/A'}}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-right"><strong>Total: {{$payslip->total_deductions ?? 'N/A'}}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" colspan="2">Employer Contributions</th>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <th class="text-right">This Pay (MYR)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>EPF</td>
                            <td class="text-right">{{$payslip->epf_employer ?? 'N/A'}}</td>
                        </tr>
                        <tr>
                            <td>SOCSO</td>
                            <td class="text-right">{{$payslip->socso_employer ?? 'N/A'}}</td>
                        </tr>
                        <tr>
                            <td>EIS</td>
                            <td class="text-right">{{$payslip->socso_eis_employer ?? 'N/A'}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" colspan="2">Summary</th>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <th class="text-right">This Pay (MYR)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Total Earnings</td>
                            <td class="text-right">{{$payslip->total_earnings ?? 'N/A'}}</td>
                        </tr>
                        <tr>
                            <td>Total Deductions</td>
                            <td class="text-right">{{$payslip->total_deductions ?? 'N/A'}}</td>
                        </tr>
                        <tr>
                            <td>Net Pay</td>
                            <td class="text-right"><strong>{{$payslip->net_wage ?? 'N/A'}}</strong></td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" colspan="2">Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                Remarks
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>


@endsection
