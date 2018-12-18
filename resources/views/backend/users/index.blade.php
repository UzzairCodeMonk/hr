@extends('backend.master')
@section('page-title')
Employees
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3>@yield('page-title')</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                @isset($results)
                @include('components.table.table',['entity'=>'employee','deleteAction'=>$deleteAction])
                @endisset
            </div>
        </div>

    </div>
</div>
@endsection


@section('page-js')
@include('asset-partials.datatable')
<script type="text/javascript">
    $(document).ready(function () {
        $('.datatable').DataTable();
    });

</script>
@endsection
