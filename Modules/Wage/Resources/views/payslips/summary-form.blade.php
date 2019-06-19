@extends('backend.master')
@section('page-title')
Generate Payslip Summary
@endsection
@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Generate Payslip Summary</h3>
        <div class="card-options">
        </div>
    </div>
    <div class="card-body">

        <!-- <form action="{{route('generate.payslip.summary')}}" class="" method="POST">
            @csrf
            <div class="form-row">
                <div class="col">
                    <label for="">Which Month?</label>
                    <select name="month" id="" class="form-control">
                        @for($m=1; $m<=12; ++$m) <option value="{{$m}}">{{ date('F', mktime(0, 0, 0, $m, 1))}}</option>
                            @endfor
                    </select> </div>
                <div class="col">
                    <label for="">Which Year?</label>
                    <?php 
                    $firstYear = (int)date('Y');
                    $lastYear = $firstYear + 5;
                    ?>
                    <select name="year" id="" class="form-control">
                        @for($i=$firstYear;$i<=$lastYear;$i++) 
                            <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <button type="submit" class="btn btn-primary btn-sm pull-right mt-2">Generate payslip summary</button>
                </div>
            </div>
        </form> -->

        <div class="mt-5"></div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Month</th>
                    <th>Year</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($summaries) && count($summaries) > 0)
                @foreach($summaries as $key=>$summary)
                <tr>
                    <!-- <td>#</td> -->
                    <td>{{++$key}}</td>
                    <td>{{getMonthNameBasedOnInt($summary->month)}}</td>
                    <td>{{$summary->year}}</td>
                    <td class="text-center">
                        <a target="_blank" href="{{URL::signedRoute('show.payslip.summary',['month'=>$summary->month,'year'=>$summary->year])}}" class="btn btn-primary btn-sm">View</a>
                        <form action="{{route('payslip-summary.delete',['id'=>$summary->id])}}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>                  
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

@endsection
@section('page-js')
@include('asset-partials.datatable')
<script type="text/javascript">
    $(document).ready(function () {
        $('.table').DataTable();
    });

</script>
@endsection
