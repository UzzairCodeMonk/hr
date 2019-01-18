<?php

use Carbon\Carbon;


function greet()
{
    $currentTime = Carbon::now();

}

function userHasNotification()
{
    return Auth::user()->unreadNotifications->count() > 0;
}

function getMonthNameBasedOnInt($value)
{
    if ($value != null) {
        $monthNum = $value;
        $dateObj = DateTime::createFromFormat('!m', $monthNum);
        $monthName = $dateObj->format('F');
        return $monthName;
    }

    return 'N/A';
}

function companyName()
{
    return DB::table('siteconfigs')->first()->company_name;
}

function siteName()
{
    return DB::table('siteconfigs')->first()->site_name;
}

function sitePhoneNumber()
{
    return DB::table('siteconfigs')->first()->phone_number;
}

function siteMobileNumber()
{
    return DB::table('siteconfigs')->first()->mobile_number;
}

function siteFaxNumber()
{
    return DB::table('siteconfigs')->first()->fax_number;
}

function siteEmail()
{
    return DB::table('siteconfigs')->first()->email;
}

function siteLogo()
{
    return DB::table('siteconfigs')->first()->logo;
}

function siteAddressOne()
{
    return DB::table('siteconfigs')->first()->address_one;
}

function siteAddressTwo()
{
    return DB::table('siteconfigs')->first()->address_two;
}

function sitePostcode()
{
    return DB::table('siteconfigs')->first()->postcode;
}

function siteCity()
{
    return DB::table('siteconfigs')->first()->city;
}

function siteState()
{
    return DB::table('siteconfigs')->first()->state;
}

function siteCountry()
{
    return DB::table('siteconfigs')->first()->country;
}

function siteFacebook()
{
    return DB::table('siteconfigs')->first()->facebook;
}

function siteTwitter()
{
    return DB::table('siteconfigs')->first()->twitter;
}

function siteGmail()
{
    return DB::table('siteconfigs')->first()->gmail;
}

function sitelinkedin()
{
    return DB::table('siteconfigs')->first()->linkedin;
}