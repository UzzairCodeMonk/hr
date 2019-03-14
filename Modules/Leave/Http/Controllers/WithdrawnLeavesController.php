<?php

namespace Modules\Leave\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Leave\Entities\Leave;
use Modules\Leave\Entities\LeaveType;

class WithdrawnLeavesController extends Controller
{
    /**
     * List withdrawn leaves
     * 
     * @return void
     */
    public function index()
    {
        return view('leave::leave.user.trashed', [
            'results' => Leave::onlyTrashed()
                ->where('user_id', auth()->id())
                ->orderBy('deleted_at', 'desc')
                ->get(),
        ]);
    }

    /**
     * Show withdrawn leaves
     * 
     * @param int $id
     */

    public function show(int $id)
    {
        return view('leave::leave.user.show-trash', [
            'leave' => Leave::onlyTrashed()->where('id', $id)->first(),
            'types' => LeaveType::all(),
            'statuses' => Leave::onlyTrashed()->where('id', $id)->first()->statuses,
        ]);
    }
}
