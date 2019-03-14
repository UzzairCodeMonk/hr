<?php

namespace Modules\Leave\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Leave\Entities\Leave;

class WithdrawnLeavesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
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

    public function show(int $id)
    {
        return view('leave::leave.user.show-trash', [
            'leave' => $this->leave->onlyTrashed()->where('id', $id)->first(),
            'types' => $this->type->all(),
            'statuses' => Leave::onlyTrashed()->where('id', $id)->first()->statuses,
        ]);
    }
}
