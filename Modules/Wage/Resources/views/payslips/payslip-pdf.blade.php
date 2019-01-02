<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/core.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <style>
        body {
            font-family: Poppins, sans-serif !important;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                {{getMonthNameBasedOnInt($payslip->month) ?? 'N/A'}} {{$payslip->year ?? 'N/A'}} Payslip
            </h3>           
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h6><strong>{{$payslip->user->personalDetail->name ?? 'N/A'}}</strong></h6>
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
                    </table>
                </div>
                <div class="col">
                    <div class="logo-text pull-right" style="text-align:justify;width:270px">
                        <img src="{{asset(siteLogo())}}" alt="" style="display:block;margin:0 auto">
                    </div>
                    <br><br>
                    <p class="text-right mt-3">
                        <strong>{{companyName() ?? 'N/A'}}</strong><br>
                        {{siteAddressOne() ?? 'N/A'}},<br>{{siteAddressTwo() ?? 'N/A'}},<br>{{sitePostcode() ?? 'N/A'}}
                        {{siteCity() ?? 'N/A'}},
                        {{siteCountry() ?? 'N/A'}}
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
                                <td class="text-right">{{number_format($payslip->basic_salary,2) ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <td>Allowance</td>
                                <td class="text-right">{{number_format($payslip->allowance,2) ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-right"><strong>Total:
                                        {{number_format($payslip->total_earnings,2) ?? 'N/A'}}</strong></td>
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
                                <td class="text-right">{{number_format($payslip->epf_employee,2) ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <td>SOCSO</td>
                                <td class="text-right">{{number_format($payslip->socso_employee,2) ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <td>EIS</td>
                                <td class="text-right">{{number_format($payslip->socso_eis_employee,2) ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-right"><strong>Total:
                                        {{number_format($payslip->total_deductions,2) ?? 'N/A'}}</strong></td>
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
                                <td class="text-right">{{number_format($payslip->epf_employer,2) ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <td>SOCSO</td>
                                <td class="text-right">{{number_format($payslip->socso_employer,2) ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <td>EIS</td>
                                <td class="text-right">{{number_format($payslip->socso_eis_employer,2) ?? 'N/A'}}</td>
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
                                <td class="text-right">{{number_format($payslip->total_earnings,2) ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <td>Total Deductions</td>
                                <td class="text-right">{{number_format($payslip->total_deductions,2) ?? 'N/A'}}</td>
                            </tr>
                            <tr>
                                <td>Net Pay</td>
                                <td class="text-right"><strong>{{number_format($payslip->net_wage,2) ?? 'N/A'}}</strong></td>
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
                                    {!! $payslip->remarks !!}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</body>

</html>
