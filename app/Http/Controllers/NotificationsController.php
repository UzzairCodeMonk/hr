<?php

namespace Datakraf\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class NotificationsController extends Controller
{

    public function index()
    {
        $notifications = auth()->user()->notifications;
        return view('backend.notifications.index', compact('notifications'));
    }

    public function getMyNotifications()
    {

        return response()->json(auth()->user()->unreadNotifications, 200);
    }

    public function markAsRead(Request $request)
    {

        return response()->json(auth()->user()->notifications->where('id', $request->id)->first()->markAsRead(), 200);
    }

    public function deleteNotifications(Request $request)
    {

        $ids = $request->ids;
        if (count($ids) > 0) {           
            // if mark as read
            if ($request->has('mark-read')) {
                foreach ($ids as $id) {
                    DB::table('notifications')->where('id', $id)->update(['read_at' => now()]);
                    toast('Selected records marked as read', 'success', 'top-right');
                    return back();
                }
            }
        }
        toast('Please select a record before delete', 'error', 'top-right');
        return back();
    }
}
