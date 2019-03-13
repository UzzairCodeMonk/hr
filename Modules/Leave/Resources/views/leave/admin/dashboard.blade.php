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
{!! Charts::assets() !!}
@endsection
@section('content')

<div class="col-md-8 mx-auto">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col">
            <div class="">
                <h1 class="display-5">Leave Modules</h1>
                <!-- <p class="display-6">Here's what's happening in Datakraf Solution Sdn. Bhd.</p> -->
            </div>
        </div>
        <div class="col mx-auto">
            <img src="{{asset('images/dashboard/requests.svg')}}" alt="" class="" height="400px">
        </div>
    </div>
    <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Leave Applications By Month</h3>                        
                    </div>
                    <div class="card-body">
                            {!! $chart->render() !!}
                    </div>
                </div>
    
            </div>
        </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Who's not in the office?</h3>
                    <div class="card-options">
                        <select name="" id="daysSelector" class="form-control">
                            <option value="7">In 7 Days</option>
                            <option value="30">In 30 Days</option>
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    @widget('absenteesWidget')
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Upcoming Events</h3>
                </div>
                <div class="card-body">
                    <table class="table table-card datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Event Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Hello</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('page-js')

@endsection