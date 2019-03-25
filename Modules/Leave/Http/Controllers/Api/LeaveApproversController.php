<?php

namespace Modules\Leave\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Datakraf\User;

class LeaveApproversController extends Controller
{
    
    public function index($id)
    {
        $user = User::where('id', $id)->with('leaveApprovers')->get();

        return response()->json([
            'success' => true,
            'user' => $user
        ]);
    }
    
}
