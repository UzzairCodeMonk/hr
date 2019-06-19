<?php

namespace Modules\Leave\Http\Controllers;

use Datakraf\User;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Leave\Entities\LeaveBalance;
use Modules\Leave\Entities\LeaveType;

class LeaveBalanceCalculatorController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $users = User::get();

        foreach ($users as $user) {

            $approved_leaves = [];

            foreach ($user->leaves as $leave) {
                if ($leave->status == 'approved') {

                    $approved_leaves[] = $leave;
                }
            }

            $leaves = collect($approved_leaves);

            $grouped_approved_leaves = $leaves->mapToGroups(function ($item, $key) {

                return [$item['leavetype_id'] => $item['days_taken']];

            });

            $arr = $grouped_approved_leaves->toArray();

            foreach ($arr as $key => $leave) {

                $leave_sum = collect($leave)->sum();

                $leave_balance = LeaveBalance::where('user_id', $key)->first();
                $leave_type = LeaveType::find($key)->first();
                
                if ($leave_balance != null) {

                    $leave_balance->updateOrCreate(
                        
                        ['leavetype_id' => $key, 'user_id' => $user->id],
                        ['balance' => $leave_type->days - $leave_sum]);

                }

            }          

        }

        toast('Employees leave balance calculated and reset successfully','success', 'top-right');
        
        return redirect()->back();
    }

}
