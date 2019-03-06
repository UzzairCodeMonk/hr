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

</style>
@endsection
@section('content')

<div class="col-md-8 mx-auto">
    <div class="row h-100 justify-content-center align-items-center">
        <div class="col">
            <div class="">
                <h1 class="display-5">Hi Muhammad Uzzair Bin Baharudin!</h1>
                <p class="display-6">Here's what's happening in Datakraf Solution Sdn. Bhd.</p>
            </div>

        </div>
        <div class="col">
            <img src="{{asset('images/dashboard-image.png')}}" alt="" class="img-fluid">
        </div>
    </div>
    <div class="row">
        @include('components.admin.panel',[
        'title' => ' 19 Employees',
        'img' => asset('images/dashboard/employees.svg'),
        'link' => ''
        ])
        @include('components.admin.panel',[
        'title' => ' 19 Employees',
        'img' => asset('images/dashboard/employees.svg'),
        'link' => ''
        ])
        @include('components.admin.panel',[
        'title' => ' 19 Employees',
        'img' => asset('images/dashboard/employees.svg'),
        'link' => ''
        ])
        @include('components.admin.panel',[
        'title' => ' 19 Employees',
        'img' => asset('images/dashboard/employees.svg'),
        'link' => ''
        ])
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Who's not in the office?</h3>
                </div>
                <div class="card-body">
                    <table class="table table-card datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Hello</td>
                                <td>Hehead</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
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
