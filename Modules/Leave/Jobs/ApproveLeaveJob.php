<?php

namespace Modules\Leave\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\Leave\Entities\Leave;
use Carbon\Carbon;
use DateTime;
use Auth;
use Modules\Leave\Entities\LeaveBalance;

class ApproveLeaveJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $leave;
    protected $approvedStatus = 'approved';
    /**
     * Create a new job instance.
     *
     * @return void
     */
   
    public function __construct($leave,$status)
    {
        //
        $this->leave = $leave;
        //check berp hari dah apply leave by user
        $today=Carbon::now();
        $stats = Leave::adminLeaveStatus($status);
        
        foreach($stats as $l){
            $created_at = new DateTime($l->created_at);
            $today_date = new DateTime(date('Y-m-d H:i:s'));

            $days = $today_date->diff($created_at);
            
            if($days->days >= 3){
               
                if($status == 'submitted'){
                    // find the total days allowed for that particular leave type
                    $totalAllowedDaysOfLeave = $l->type->days;
                    // find total days taken for this leave
                    $totalDaysTaken = $l->days_taken;
                    // find the balance after approval
                    $balance = $totalAllowedDaysOfLeave - $totalDaysTaken;
                     // check the user's leave type available balance
                    $balanceexist = LeaveBalance::where('leavetype_id', $l->leavetype_id)->where('user_id', $l->user_id)->exists();
                    if($balanceexist == true){
                        $that_leave = LeaveBalance::where('leavetype_id', $l->leavetype_id)->where('user_id', $l->user_id)->first();
                        $balance1 = $that_leave->balance - $totalDaysTaken;
                        LeaveBalance::updateOrCreate(['user_id' => $l->user_id, 'leavetype_id' => $l->leavetype_id], ['balance' => $balance1]);
                    }
                    else{
                        // update or create leave balance record in leavebalances table
                        LeaveBalance::updateOrCreate(['user_id' => $l->user_id, 'leavetype_id' => $l->leavetype_id], ['balance' => $balance]);
                    }
                    $l->setStatus($this->approvedStatus, 'Leave approved by ' . Auth::user()->name);
                    $l->user->notify(new ApproveLeave($l, $l->user, Auth::user()));
                }
            }

        }
        
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        // $leave = $this->leave->all();
        // dd($leave);
    }
}
