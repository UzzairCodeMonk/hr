<?php

function statusColor($value)
{
    switch ($value) {
        case "leave-approved":
            echo "badge-success";
            break;
        case "leave-rejected":
            echo "badge-danger";
            break;
        case "leave-submitted":
            echo "badge-warning";
            break;
        default:
            echo "badge-primary";
    }
}