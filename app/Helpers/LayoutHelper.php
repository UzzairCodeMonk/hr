<?php

use Carbon\Carbon;

function greet()
{
    $currentTime = Carbon::now();

}

function getMonthNameBasedOnInt($value)
{
    $monthNum = $value;
    $dateObj = DateTime::createFromFormat('!m', $monthNum);
    $monthName = $dateObj->format('F');

    return $monthName;
}