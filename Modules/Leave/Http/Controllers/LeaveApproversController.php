<?php

namespace Modules\Leave\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Datakraf\User;

class LeaveApproversController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $results = User::with('leaves')->get();
        return view('leave::approvers.index',[
            'results' => $results
        ]);
    }

    public function store(Request $request){
        
    }

}
