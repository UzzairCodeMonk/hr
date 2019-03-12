<?php

namespace Modules\Leave\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Leave\Entities\Leave;

class LeavesController extends Controller
{
    
    public function fetchLeaveApprovers(int $id)
    {

        $approvers = Leave::find($id)->approvers;

        $formatted_approvers = [];

        foreach ($approvers as $approver) {
            $formatted_approvers[] = ['id' => $approver->id, 'text' => $approver->name];
        }
        return response()->json($formatted_approvers);
    }
}
