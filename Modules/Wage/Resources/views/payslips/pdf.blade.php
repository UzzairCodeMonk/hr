<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />

    <title>{{getMonthNameBasedOnInt($payslip->month) ?? 'N/A'}} {{$payslip->year ?? 'N/A'}} Payslip</title>
    <link rel='stylesheet' type='text/css' href="{{asset('css/payslip/print.css')}}" />

    <style>
        body {
            font-family: Poppins, sans-serif !important;
        }   @media(print){
            #header { height: 15px; width: 100%; margin: 20px 0; background: #222; text-align: center; color: white; font: bold 15px Helvetica, Sans-Serif; text-decoration: uppercase; letter-spacing: 10px; padding: 8px 0px; }
        }
    </style>
</head>

<body>

    <div id="page-wrap">

        <div id="header">{{getMonthNameBasedOnInt($payslip->month) ?? 'N/A'}} {{$payslip->year ?? 'N/A'}} Payslip</div>

        <div id="identity">
            <div id="employee-details">
                <p><strong>{{$payslip->user->personalDetail->name ?? 'N/A'}}</strong></p>
                <p>Employee #: {{$payslip->user->personalDetail->staff_number ?? 'N/A'}}</p>
                <p>Position: {{$payslip->user->personalDetail->position->name ?? 'N/A'}}</p>
                <p>Passport/IC No: {{$payslip->user->personalDetail->ic_number ?? 'N/A'}}</p>
                <p>Income Tax No.:{{$payslip->user->personalDetail->income_tax_no ?? 'N/A'}}</p>
            </div>
            <div id="address">
                <div id="logo">
                    <img id="image" src="{{asset(siteLogo())}}" alt="" style="display:block;margin:0 auto">
                </div>
                <div class="company-address">
                    <strong>{{companyName() ?? 'N/A'}}</strong><br>
                    {{siteAddressOne() ?? 'N/A'}},<br>{{siteAddressTwo() ?? 'N/A'}},<br>{{sitePostcode() ?? 'N/A'}}
                    {{siteCity() ?? 'N/A'}},
                    {{siteCountry() ?? 'N/A'}}
                </div>

            </div>
        </div>


        <div style="clear:both"></div>

        <table id="items">
            <tr>
                <th colspan="5">Earnings</th>
            </tr>
            <tr>
                <th colspan="3">Description</th>
                <th colspan="2">Amount (MYR)</th>
            </tr>
            <tr class="item-row">
                <td class="item-name" colspan="3">Basic Salary</td>
                <td class="description" colspan="2">{{number_format($payslip->basic_salary,2) ?? 'N/A'}}</td>
            </tr>
            <tr class="item-row">
                <td class="item-name" colspan="3">Allowance</td>
                <td class="description" colspan="2">{{number_format($payslip->allowance,2) ?? 'N/A'}}</td>
            </tr>
            <tr class="item-row">
                <td class="item-name" colspan="3">UPL (days) in {{getMonthNameBasedOnInt($payslip->month) ?? 'N/A'}}
                    {{$payslip->year ?? 'N/A'}}</td>
                <td class="description" colspan="2">{{number_format($payslip->upl_days,1) ?? 'N/A'}}</td>
            </tr>
            @if(isset($payslip->upl_days) && $payslip->upl_days > 0)
            <tr class="item-row">
                <td class="item-name" colspan="3">UPL Deduction</td>
                <td class="description" colspan="2"> -{{number_format($payslip->upl_amount,2) ?? 'N/A'}}</td>
            </tr>
            @endif
            <tr>
                <td class="description" colspan="5"><strong>Total:
                        {{number_format($payslip->total_earnings,2) ?? 'N/A'}}</strong></td>
            </tr>
        </table>
        <table id="items">
            <tr>
                <th colspan="5">Employee Contributions</th>
            </tr>
            <tr>
                <th colspan="3">Description</th>
                <th colspan="2">Amount (MYR)</th>
            </tr>
            <tr class="item-row">
                <td class="item-name" colspan="3">EPF</td>
                <td class="description" colspan="2">{{number_format($payslip->epf_employee,2) ?? 'N/A'}}</td>
            </tr>
            <tr class="item-row">
                <td class="item-name" colspan="3">SOCSO</td>
                <td class="description" colspan="2">{{number_format($payslip->socso_employee,2) ?? 'N/A'}}</td>
            </tr>
            <tr class="item-row">
                <td class="item-name" colspan="3">EIS</td>
                <td class="description" colspan="2">{{number_format($payslip->socso_eis_employee,2) ?? 'N/A'}}</td>
            </tr>
            <tr class="item-row">
                <td class="item-name" colspan="3">HRDF</td>
                <td class="description" colspan="2">{{number_format($payslip->hrdf,2) ?? 'N/A'}}</td>
            </tr>
            <tr>
                <td class="description" colspan="5"><strong>Total:
                        {{number_format($payslip->total_deductions,2) ?? 'N/A'}}</strong></td>
            </tr>
            <tr style="visibility:hidden">
                <td></td>
            </tr>
            <tr style="visibility:hidden">
                <td></td>
            </tr>
        </table>
        <table id="items">
            <tr>
                <th colspan="5">Employer Contributions</th>
            </tr>
            <tr>
                <th colspan="3">Description</th>
                <th colspan="2">Amount (MYR)</th>
            </tr>
            <tr class="item-row">
                <td class="item-name" colspan="3">EPF</td>
                <td class="description" colspan="2">{{number_format($payslip->epf_employer,2) ?? 'N/A'}}</td>
            </tr>
            <tr class="item-row">
                <td class="item-name" colspan="3">SOCSO</td>
                <td class="description" colspan="2">{{number_format($payslip->socso_employer,2) ?? 'N/A'}}</td>
            </tr>
            <tr class="item-row">
                <td class="item-name" colspan="3">EIS</td>
                <td class="description" colspan="2">{{number_format($payslip->socso_eis_employer,2) ?? 'N/A'}}</td>
            </tr>            
        </table>
        <table id="items">
            <tr>
                <th colspan="5">Summary</th>
            </tr>
            <tr>
                <th colspan="3">Description</th>
                <th colspan="2">Amount (MYR)</th>
            </tr>
            <tr class="item-row">
                <td class="item-name" colspan="3">Total Earnings</td>
                <td class="description" colspan="2">{{number_format($payslip->total_earnings,2) ?? 'N/A'}}</td>
            </tr>
            <tr class="item-row">
                <td class="item-name" colspan="3">Total Deductions</td>
                <td class="description" colspan="2"> -{{number_format($payslip->total_deductions,2) ?? 'N/A'}}</td>
            </tr>
            <tr class="item-row">
                <td class="item-name" colspan="3">Net Pay</td>
                <td class="description" colspan="2"><strong>{{number_format($payslip->net_wage,2) ?? 'N/A'}}</strong></td>
            </tr>
        </table>
        <div style="clear:both"></div>
        <table id="remarks">
            <tr>
                <th>Remarks</th>
            </tr>
            <tr class="item-row">
                <td>{!! $payslip->remarks !!}</td>
            </tr>
        </table>

    </div>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            window.print();
        });

    </script>
</body>

</html>
