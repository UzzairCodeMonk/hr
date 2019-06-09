<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
    <title> Payslip Summary - {{getMonthNameBasedOnInt($summary->month) ?? ''}} {{$summary->year ??
            ''}}</title>
    <style type="text/css" media="print">
        body {
            font-family: Arial, sans-serif !important;
        }

        #header {
            height: 15px;
            width: 100%;
            margin: 20px 0;
            background: #222;
            text-align: center;
            color: white;
            font: bold 15px Helvetica, Sans-Serif;
            text-decoration: uppercase;
            letter-spacing: 10px;
            padding: 8px 0px;
        }

        td.null {
            background-color: black;
        }

        table {
            border-collapse: collapse;
            font-size: 12px;
            border:1px solid #000;
        }

        table tr,
        table td,
        table th {
            border: 1px solid black;
            padding: 5px;
            text-align: center
        }

        @page {
            size: landscape;
        }

    </style>
</head>

<body>

    <div id="page-wrap" class="container">
    <table class="table table-bordered table-condensed">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Basic Salary (MYR)</th>
                    <th>Allowance (MYR)</th>
                    <th class="bg-dark text-white">EPF Employer (MYR)</th>
                    <th>EPF Employee (MYR)</th>
                    <th class="bg-dark text-white">SOCSO Employer (MYR)</th>
                    <th>SOCSO Employee (MYR)</th>
                    <th class="bg-dark text-white">EIS Employer (MYR)</th>
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
                    <td style="@media print{background:black}"></td>
                </tr>
                <tr>
                    <td colspan="12">
                        <p style="float:right">
                            Total Employer Expenses :
                            MYR {{number_format($summary->employer_expenses,2,'.','') ?? 0.00}}
                        </p>

                    </td>
                </tr>
            </tbody>
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
