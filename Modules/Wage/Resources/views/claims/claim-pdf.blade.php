<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
    <title> Claim Records - {{$claim->user->name}} </title>
    <h3><b>Claim Records</b> - {{$claim->user->name}} </h3>
    <p>Claim Subject : {{$claim->subject}}</p>
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

        @page {
            size: landscape;
        }
    </style>
</head>

<body>

    <div id="page-wrap" class="container">
        <table class="" style="width:100%;text-align: center;border-left: 1px solid black;
        border-right: 1px solid black;
        border-top: 1px solid black;
        border-bottom: 1px solid black;
        border-collapse: collapse;">
            <thead>
                <tr>
                    <th style="background-color:#2F4F4F;color:#FFFFFF;text-align: center;border-left: 1px solid black;
                    border-right: 1px solid black;
                    border-top: 1px solid black;
                    border-bottom: 1px solid black;">#</th>
                    <th style="background-color:#2F4F4F;color:#FFFFFF;text-align: center;border-left: 1px solid black;
                    border-right: 1px solid black;
                    border-top: 1px solid black;
                    border-bottom: 1px solid black;">Category</th>
                    <th style="background-color:#2F4F4F;color:#FFFFFF;text-align: center;border-left: 1px solid black;
                    border-right: 1px solid black;
                    border-top: 1px solid black;
                    border-bottom: 1px solid black;">Date</th>
                    <th style="background-color:#2F4F4F;color:#FFFFFF;text-align: center;border-left: 1px solid black;
                    border-right: 1px solid black;
                    border-top: 1px solid black;
                    border-bottom: 1px solid black;">Amount</th>
                    <th style="background-color:#2F4F4F;color:#FFFFFF;text-align: center;border-left: 1px solid black;
                    border-right: 1px solid black;
                    border-top: 1px solid black;
                    border-bottom: 1px solid black;">Remarks</th>
                    <th style="background-color:#2F4F4F;color:#FFFFFF;text-align: center;border-left: 1px solid black;
                    border-right: 1px solid black;
                    border-top: 1px solid black;
                    border-bottom: 1px solid black;">Attachments</th>
                </tr>
            </thead>
            <tbody>
                @foreach($claim->details as $key => $detail)
                <tr>
                    <td style="text-align: center;border-left: 1px solid black;
                    border-right: 1px solid black;
                    border-top: 1px solid black;
                    border-bottom: 1px solid black;">{{++$key}}</td>
                    <td style="text-align: center;border-left: 1px solid black;
                    border-right: 1px solid black;
                    border-top: 1px solid black;
                    border-bottom: 1px solid black;">{!!$detail->type->name ?? 'N/A'!!}</td>
                    <td style="text-align: center;border-left: 1px solid black;
                    border-right: 1px solid black;
                    border-top: 1px solid black;
                    border-bottom: 1px solid black;">{{$detail->date ?? 'N/A'}}</td>
                    <td style="text-align: center;border-left: 1px solid black;
                    border-right: 1px solid black;
                    border-top: 1px solid black;
                    border-bottom: 1px solid black;">{{$detail->amount ?? 0.00}}</td>
                    <td style="text-align: center;border-left: 1px solid black;
                    border-right: 1px solid black;
                    border-top: 1px solid black;
                    border-bottom: 1px solid black;">{!! $detail->remarks ?? 'N/A' !!}</td>
                    <td style="text-align: left;border-left: 1px solid black;
                    border-right: 1px solid black;
                    border-top: 1px solid black;
                    border-bottom: 1px solid black;">
                        <ul>
                            @if($detail->attachments->count() > 0)
                            @foreach($detail->attachments as $attachment)
                            <li>
                                <a href="{{url($attachment->filepath) ?? ''}}" target="_blank">
                                    {{ $attachment->filename }}
                                </a>
                            </li>
                            @endforeach
                            @else
                            <li> No attachments available.</li>
                            @endif
                        </ul>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td style="text-align: center;border-left: 1px solid black;
                    border-right: 1px solid black;
                    border-top: 1px solid black;
                    border-bottom: 1px solid black;"></td>
                    <td style="text-align: center;border-left: 1px solid black;
                    border-right: 1px solid black;
                    border-top: 1px solid black;
                    border-bottom: 1px solid black;"></td>
                    <td style="text-align: center;border-left: 1px solid black;
                    border-right: 1px solid black;
                    border-top: 1px solid black;
                    border-bottom: 1px solid black;"></td>
                    <td style="text-align: center;border-left: 1px solid black;
                    border-right: 1px solid black;
                    border-top: 1px solid black;
                    border-bottom: 1px solid black;"></td>
                    <td style="background-color:#2F4F4F;color:#FFFFFF;text-align: center;border-left: 1px solid black;
                    border-right: 1px solid black;
                    border-top: 1px solid black;
                    border-bottom: 1px solid black;" class="text-right">Total</td>
                    <td style="background-color:#2F4F4F;color:#FFFFFF;text-align: center;border-left: 1px solid black;
                    border-right: 1px solid black;
                    border-top: 1px solid black;
                    border-bottom: 1px solid black;">MYR {{$claim->amount ?? 0.00}}</td>
                </tr>
            </tbody>
        </table>

    </div>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            window.print();
        });
    </script>
</body>

</html>