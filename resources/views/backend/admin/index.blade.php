@extends('backend.master')
@section('page-title')
Administration Panel
@endsection
@section('content')
<div class="container">    
    <div class="row">
        @include('components.admin.panel',[
        'title' => 'Employees',
        'img' => asset('images/dashboard/employees.svg'),
        'description' => 'View and manage employees profiles',
        'link' => route('user.index'),
        'linkClass' => 'btn-primary',
        'linkText' => 'Manage'
        ])

        @include('components.admin.panel',[
        'title' => 'Leave',
        'img' => asset('images/dashboard/requests.svg'),
        'description' => 'View, approve or reject employees leave applications',
        'link' => route('leave.index'),
        'linkClass' => 'btn-primary',
        'linkText' => 'Manage'
        ])
        @include('components.admin.panel',[
        'title' => 'Wage',
        'img' => asset('images/dashboard/wage.svg'),
        'description' => 'Calculate and generate employees payslips',
        'link' => route('payslip.index'),
        'linkClass' => 'btn-primary',
        'linkText' => 'Manage'
        ])
        @include('components.admin.panel',[
        'title' => 'Roles and Permissions',
        'img' => asset('images/dashboard/roles.svg'),
        'description' => 'Manage employees roles and permissions',
        'link' => route('roles.index'),
        'linkClass' => 'btn-primary',
        'linkText' => 'Manage'
        ])
        @include('components.admin.panel',[
        'title' => 'Site Configurations',
        'img' => asset('images/dashboard/config.svg'),
        'description' => 'Manage site configurations',
        'link' => route('siteconfig.index'),
        'linkClass' => 'btn-primary',
        'linkText' => 'Manage'
        ])

    </div>
</div>
@endsection
