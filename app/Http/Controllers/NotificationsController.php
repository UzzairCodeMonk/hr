<?php

namespace Datakraf\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class NotificationsController extends Controller
{
    public function markAsRead($id)
    {
        $notifications = DB::table('notifications')->where('id', $id)->update(['read_at' => now()]);
    }
}
