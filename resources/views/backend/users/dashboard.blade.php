@extends('backend.master')
@section('page-title')
Dashboard
@endsection
@section('page-css')
<style>
    .aside {
        display: none !important;
    }

    .aside~.header,
    .aside~.main-content,
    .aside~.site-footer {
        margin-left: 0 !important;
    }

    .equal {
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        flex-wrap: wrap;
    }

    .equal>[class*='col-'] {
        display: flex;
        flex-direction: column;
    }

</style>
@endsection
@section('content')

<div class="col-md-8 mx-auto">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col">
            <div class="">
                <h1 class="display-5">Hi {!!auth()->user()->personalDetail->name ?? '' !!}!</h1>
                <p class="display-6">Here's what's happening in Datakraf Solution Sdn. Bhd.</p>
            </div>

        </div>
        <div class="col">
            <img src="{{asset('images/dashboard/employees.svg')}}" alt="" class="img-fluid">
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <canvas id="pieChart" width="400" height="400"></canvas>
        </div>
    </div>
</div>


@endsection

@section('page-js')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

<script type="text/javascript">

    var ctx = document.getElementById("pieChart");
    var data = fetch("{{route('stats')}}").then(res => res.json());    

    var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ["Male","Female"],
            datasets: [{
                animationDuration: 0,
                data: data,
                backgroundColor: [
                    '#FF0000',
                    '#62BB46'                    
                ],
                borderWidth: 0
            }]
        },
        options: {
            hover: {
                display: true
            },
            legend: {
                display: true
            }
        }
    });

</script>
@endsection
