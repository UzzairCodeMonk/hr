<?php

namespace Datakraf\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class NotificationsController extends Controller
{
    public function getMyNotifications()
    {
        return view('backend.notifications.index', ['notifications' => auth()->user()->notifications]);
    }

    public function markAsRead($id)
    {
        DB::table('notifications')->where('id', $id)->update(['read_at' => now()]);
    }

    public function deleteNotifications(Request $request)
    {
        // dd($request->ids);
        foreach ($request->ids as $id) {
            DB::table('notifications')->where('id',$id)->delete();
        }
        return back();
    }
}
