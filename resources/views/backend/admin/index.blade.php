@extends('backend.master')
@section('page-title')
Administration Panel
@endsection
@section('content')
<div class="container">
    <header class="header bg-ui-general">
        <div class="header-info" style="margin:11px 0 !important;">
            <h1 class="header-title">
                <strong>Administration</strong> Panels
                <small>Contains various Datakraf HRMS administration controls.</small>
            </h1>
        </div>
    </header>

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
        'link' => route('leave.admin.index'),
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
