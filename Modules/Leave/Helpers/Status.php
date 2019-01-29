<?php

function statusColor($value)
{
    switch ($value) {
        case "approved":
            echo "badge-success";
            break;
        case "rejected":
            echo "badge-danger";
            break;
        case "submitted":
            echo "badge-warning";
            break;
        default:
            echo "badge-primary";
    }
}

function getUserLeaveBalance($type)
{
   (DB::table('leavebalances')->where('user_id', auth()->id())->where('leavetype_id', $type->id)->exists()) ?
        DB::table('leavebalances')->where('user_id', auth()->id())->where('leavetype_id', $type->id)->first()->balance.'/'.$type->days : $type->days;
}