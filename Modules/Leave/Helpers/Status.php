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