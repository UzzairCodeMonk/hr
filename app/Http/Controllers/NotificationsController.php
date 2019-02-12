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

    public function markAsRead($id, $url = null)
    {
        DB::table('notifications')->where('id', $id)->update(['read_at' => now()]);
        if ($url != null || $url == '') {
            return redirect($url);
        }

        return redirect()->back();
    }

    public function deleteNotifications(Request $request)
    {

        $ids = $request->ids;
        if (count($ids) > 0) {     
                // if delete
                if($request->has('delete')){
                    foreach ($ids as $id) {
                    DB::table('notifications')->where('id', $id)->delete();
                    toast('Selected records deleted', 'success', 'top-right');
                    return back();
                    }
                }
                // if mark as read
                if($request->has('mark-read')){
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
