@extends('backend.master')
@section('page-title')
My Notifications
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">My Notifications</h3>
    </div>
    <form action="{{route('delete.notifications')}}" method="POST" class="notification-bulk-delete">
        @csrf
        @method('DELETE')
        <div class="card-body">
            <div class="pull-right">
                <button type="submit" name="delete" class="btn btn-sm btn-danger pull-right">Delete <span class="counter-text"></span>
                    selected records</button>
                <button type="submit" name="mark-read" class="btn btn-sm btn-primary mr-2">Mark <span class="counter-text"></span>
                    record as read</button>
            </div>

            <div class="mt-5"></div>
            <table class="table-striped table-bordered table datatable">
                <thead>
                    <tr>
                        <th><input type="checkbox" class="check-all"></th>
                        <th>#</th>
                        <th>Notifications</th>
                        <th>Date/Time</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($notifications as $key=>$n)
                    <tr>
                        <td><input type="checkbox" class="checkbox" name="ids[]" value="{{$n->id}}"></td>
                        <td>
                            {{++$key}}
                        </td>
                        <td>
                            @if(isset($n->data['type']) && $n->data['type'] == 'leave')
                            <?php $leave_id = $n->data['leave_id']; ?>
                            <a class="media" href="#" data-id="{{ $n->id }}">
                                <span class="avatar"><i class="ti-files"></i></span>
                                <!-- payslip -->
                                @elseif(isset($n->data['type']) && $n->data['type'] == 'payslip')
                                <?php $user_id = $n->data['user_id'];$month= $n->data['month'];$year= $n->data['year']; ?>
                                <a class="media" href="#" data-id="{{ $n->id }}">
                                    <span class="avatar"><i class="ti-money"></i></span>
                                    @else
                                    <a class="media" href="#">
                                        <span class="avatar"><i class="ti-user"></i></span>
                                        @endif
                                        <div class="media-body">
                                            <p>{{$n->data['message']}}</p>
                                        </div>
                                    </a>
                        </td>
                        <td>
                            {{Carbon\Carbon::parse($n->created_at)->toDayDateTimeString()}}
                        </td>
                        <td class="text-center">

                            <div class="badge badge-{{$n->read_at != null ? 'success':'danger'}} badge-lg">{{$n->read_at
                                != null ? 'Read':'Unread'}}</div>

                        </td>
                        <td class="text-center">
                            @if(isset($n->data['type']) && $n->data['type'] == 'leave')
                            <?php $leave_id = $n->data['leave_id']; ?>
                            <a class="btn btn-sm btn-secondary" href="{{URL::signedRoute('leave.employee.show',['id'=>$leave_id])}}"
                                data-id="{{ $n->id }}">
                                <!-- payslip -->
                                @elseif(isset($n->data['type']) && $n->data['type'] == 'payslip')
                                <?php $user_id = $n->data['user_id'];$month= $n->data['month'];$year= $n->data['year']; ?>
                                <a class="btn btn-sm btn-secondary" href="{{URL::signedRoute('payslip.my.record',['id'=>$user_id,'month'=>$month,'year'=>$year])}}"
                                    data-id="{{ $n->id }}">
                                    @else
                                    <a class="btn btn-sm btn-secondary" href="#">
                                        @endif
                                        View
                                    </a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </form>
</div>


@endsection
@section('page-js')
@include('asset-partials.datatable')

@include('asset-partials.checkbox-select',
['allCheckboxSelector'=>'.check-all',
'checkboxSelector'=>'.checkbox',
'inputNameOfCheckbox'=>'ids',
'selectedCheckboxCounterText'=>'.counter-text'])

<script type="text/javascript">
    $(document).ready(function () {
        $('.datatable').DataTable();
    });

</script>
<!-- @include('components.form.confirmDeleteOnSubmission',['entity'=>'notification-bulk-delete']) -->
@endsection
