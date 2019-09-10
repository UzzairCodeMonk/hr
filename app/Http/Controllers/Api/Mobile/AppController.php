<?php

namespace Datakraf\Http\Controllers\Api\Mobile;

use Illuminate\Http\Request;
use Datakraf\Http\Controllers\Controller;
use Modules\Leave\Entities\Leave;
use Illuminate\Http\Response;
use Datakraf\User;
use Auth;
use Modules\Profile\Entities\PersonalDetail;
use Datakraf\Notifications\ApplyLeave;
use Modules\Leave\Traits\LeaveStatus;

use Modules\Leave\Entities\LeaveType;
use Modules\Leave\Entities\LeaveAttachment;
use Modules\Leave\Entities\LeaveBalance;
use Datakraf\Traits\AlertMessage;
use Modules\Leave\Traits\LeaveOperations;
use Datakraf\Notifications\ApproveLeave;
use Datakraf\Notifications\RejectLeave;
use Modules\Leave\Http\Requests\ApplyLeaveRequest;
use Modules\Leave\Entities\Holiday;
use Datakraf\Notifications\RetractLeave;
use Modules\Site\Entities\Center;
use Carbon\Carbon;
use Uzzaircode\DateHelper\Traits\DateHelper;
use Calendar;
use Modules\Leave\Traits\LeavesCalendar;
use Modules\Leave\Entities\LeaveEntitlement;
use Datakraf\Notifications\AdminLeaveRemark;
use Modules\Profile\Entities\Family;
use Modules\Profile\Entities\FamilyType;
use Modules\Profile\Entities\Academic;
use Modules\Profile\Entities\Experience;
use Modules\Profile\Entities\Skill;
use Modules\Profile\Entities\Award;
use DB;

class AppController extends Controller
{
    use LeaveStatus, DateHelper, LeaveOperations, LeavesCalendar;

    public $type;
    public $data;
    public $leave;
    public $user;
    public $attachment;
    public $balance;
    public function __construct(Leave $leave, LeaveType $type, Request $request, User $user, LeaveAttachment $attachment, LeaveBalance $balance, Holiday $holiday,Family $familyRecord, FamilyType $familyType)
    {
        $this->type = $type;
        
        $this->leave = $leave;
        $this->user = $user;
        $this->attachment = $attachment;
        $this->balance = $balance;
        $this->holiday = $holiday;
        $this->familyRecord = $familyRecord;
        $this->familyType = $familyType;
    }
    //
    protected $approvedStatus = 'approved';
    protected $rejectedStatus = 'rejected';
    protected $submittedStatus = 'submitted';
    protected $retractedStatus = 'withdrawn';
    protected $remarkStatus = 'remarks';

    public function leaveSubmitted(){
        $data = Leave::with('user','type')->adminLeaveStatus($this->submittedStatus);
        return \Response::json($data);
    }

    public function leaveApproved(){
        $data = Leave::with('user','type')->adminLeaveStatus($this->approvedStatus);
        return \Response::json($data);
    }

    public function leaveRejected(){
        $data = Leave::with('user','type')->adminLeaveStatus($this->rejectedStatus);
        return \Response::json($data);
    }

    public function leaveWithdrawn(){
        $data = Leave::with('user','type')->adminLeaveStatus($this->retractedStatus);
        return \Response::json($data);
    }

    //for auth user detail
    public function authUser(){
        $personalDetail = PersonalDetail::with('user','bank','position','center')->where('user_id', auth()->id())->first();
        return \Response::json($personalDetail);
    }

    public function leaveSubmittedByAuth(){
        $data = Leave::with('user','type')->leaveStatus($this->submittedStatus);
        return \Response::json($data);
    }

    public function leaveApprovedByAuth(){
        $data = Leave::with('user','type')->leaveStatus($this->approvedStatus);
        return \Response::json($data);
    }

    public function leaveRejectedByAuth(){
        $data = Leave::with('user','type')->leaveStatus($this->rejectedStatus);
        return \Response::json($data);
    }

    public function leaveWithdrawnByAuth(){
        $data = Leave::with('user','type')->leaveStatus($this->retractedStatus);
        return \Response::json($data);
    }
    //search approver
    public function searchUser(Request $request){
        $term = trim($request->q);

        if (empty($term)) {
            return \Response::json([]);
        }

        $users = User::search($term)->whereHas('personalDetail', function ($q) {
            $q->where('status', '!=', 'resigned');
        })->limit(5)->get();

        $formatted_users = [];

        foreach ($users as $user) {
            $formatted_users[] = ['id' => $user->id, 'text' => $user->name];
        }

        return \Response::json($formatted_users);
    }
    public function allUser(){
        $data = User::with("personalDetail")->get()->where("personalDetail.status", "!=", "resigned")
        ->sortBy('personalDetail.staff_number')->values()->all();
        return \Response::json($data);
    }

    public function showLeave(int $id){
        $data = Leave::with('user','type','approvers','attachments')->find($id);
        
        //calculate prorated leave yg layak ambil ikut bulan
        $today = Carbon::now();
        $month = $today->month;
        $leaveentitle=LeaveEntitlement::where('user_id',$data->user_id)->first();
        $day=$data->user->leaveEntitlement->days;

        $prorated_leave=$day / 12 * $month;
        $available = number_format($prorated_leave);
        $leaveentitle->available_annualleave = $available;
        $leaveentitle->save();

        $balance =LeaveBalance::where('user_id',$data->user_id)->where('leavetype_id',7)->exists();
        if($balance == true){
            $b = LeaveBalance::where('user_id',$data->user_id)->where('leavetype_id',7)->first();
            $thismonth = $leaveentitle->available_annualleave - ($day - $b->balance);

            if($thismonth <= 0){
                $thismonth = 0 ;
            }

        }else{
            $thismonth = $leaveentitle->available_annualleave;
        }
        return \Response::json($data);
    }
    public function applyLeave(Request $request){
       
        //check leave lebih dari prorated
        if($request->leavetype_id==7){
            $start_date = $this->setDateObject('d/m/Y', $request->start_date);
            $end_date = $this->setDateObject('d/m/Y', $request->end_date);
            $nonWorkingDays = auth()->user()->personalDetail->center->holidays->pluck('name')->toArray();
            $holidays = Holiday::pluck('date')->toArray();
            
            $h = collect($holidays)->map(function ($item, $key) {
                return Carbon::createFromFormat(config('app.date_format'), $item)->format('Y-m-d');
            });
            $holidays1 = $h->toArray();
            $days = $this->getDateRangeExcludingHolidaysOrNonWorkingDays($start_date, $end_date, $holidays1, $nonWorkingDays);
            $d = collect($days)->map(function ($item, $key) {
                return $item->format('l d F Y');
            });
            // dd($d->toJson());
            $days_taken = collect($days)->count();
            $entitle = auth()->user()->leaveEntitlement->days;
            $balanceexist = LeaveBalance::where('user_id',auth()->user()->id)->exists();
            if($balanceexist == true){
                $balance = LeaveBalance::where('user_id',auth()->user()->id)->first()->balance;
                $leave_apply = $days_taken + ($entitle - $balance);
                if($leave_apply >  auth()->user()->leaveEntitlement->available_annualleave){
                    return response()->json(null,204);
                }else{
                   
                    $leave = $this->leave->create([
                            'user_id' => auth()->user()->id,
                            'leavetype_id' => $request->leavetype_id,
                            'start_date' => $request->start_date,
                            'end_date' => $request->end_date,
                            'notes' => $request->notes,
                        ]);
                    // determine if its half day or full day
                    $this->daySelector($request, $leave);
                    // notify HR
                    $this->notifyLeaveApplicationToRecipients($request->users, $leave, new ApplyLeave($leave, auth()->user()));
                    // set leave status
                    $this->setLeaveStatus($leave);
                    // save attachments
                    $this->saveAttachments($request, $leave);
            
                    return response()->json($leave,200);
                }
            }else{
                if($days_taken >  auth()->user()->leaveEntitlement->available_annualleave){
                    return response()->json(null,204);
                }else{
                
                    $leave = $this->leave->create([
                        'user_id' => auth()->user()->id,
                        'leavetype_id' => $request->leavetype_id,
                        'start_date' => $request->start_date,
                        'end_date' => $request->end_date,
                        'notes' => $request->notes
                        ]);
                    // determine if its half day or full day
                    $this->daySelector($request, $leave);
                    // notify HR
                    $this->notifyLeaveApplicationToRecipients($request->users, $leave, new ApplyLeave($leave, auth()->user()));
                    // set leave status
                    $this->setLeaveStatus($leave);
                    // save attachments
                    $this->saveAttachments($request, $leave);
            
                    return response()->json($leave,200);
                }
            }
        }else{
            //create leave
        
            $leave = $this->leave->create([
                'user_id' => auth()->user()->id,
                'leavetype_id' => $request->leavetype_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'notes' => $request->notes
            ]);
            // determine if its half day or full day
            $this->daySelector($request, $leave);
            // notify HR
            if($request->users){
                $this->notifyLeaveApplicationToRecipients($request->users, $leave, new ApplyLeave($leave, auth()->user()));
            }
            // set leave status
            $this->setLeaveStatus($leave);
            // save attachments
            $this->saveAttachments($request, $leave);
            return response()->json($leave,200);
           
        }

    }

    public function saveTotalDaysTaken($leave)
    {
        $start_date = $this->setDateObject('d/m/Y', $leave->start_date);
        $end_date = $this->setDateObject('d/m/Y', $leave->end_date);
        $nonWorkingDays = auth()->user()->personalDetail->center->holidays->pluck('name')->toArray();
        $holidays = Holiday::pluck('date')->toArray();
        $h = collect($holidays)->map(function ($item, $key) {
            return Carbon::createFromFormat(config('app.date_format'), $item)->format('Y-m-d');
        });
        $holidays1 = $h->toArray();
        $days = $this->getDateRangeExcludingHolidaysOrNonWorkingDays($start_date, $end_date, $holidays1, $nonWorkingDays);
        $d = collect($days)->map(function ($item, $key) {
            return $item->format('l d F Y');
        });
        // dd($d->toJson());
        $leave->days_taken = collect($days)->count();
        $leave->date_series = collect($d)->implode(',');
        $leave->save();
    }

    public function notifyLeaveApplicationToRecipients(array $recipients, $leave, $notification)
    {

        // get user objects based on id from request
        $recipients = User::whereIn('id', $recipients)->get();

        // $recipients = $recipients->merge($admins);

        $approvers = $recipients->pluck('id');

        $leave->approvers()->sync($approvers);

        foreach ($recipients as $recipient) {
            $recipient->notify($notification);
        }
    }

    public function setLeaveStatus($leave)
    {
        $leave->setStatus($this->submittedStatus, 'Leave submitted for review.<br>Remarks:<br>' . $leave->notes);
    }

    public function saveAttachments($request, $leave)
    {
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                if (!empty($file)) {
                    // save the attachment with event title and time as prefix
                    $filename = time() . $file->getClientOriginalName();
                    // move the attachements to public/uploads/applicationsattachments folder
                    $file->move('uploads/leaveattachments', $filename);
                    // create attachement record in database, attach it to Ticket ID
                    $this->attachment->create([
                        'leave_id' => $leave->id,
                        'filename' => $filename,
                        'filepath' => 'uploads/leaveattachments/' . $filename
                    ]);
                }
            }
        }
    }

    public function approvalLeave(Request $request,$id){
         // find this leave model
         $leave = $this->leave->find($id);
         // find the total days allowed for that particular leave type
         $totalAllowedDaysOfLeave = $this->leave->find($id)->type->days;
         // find total days taken for this leave
         $totalDaysTaken = $this->leave->find($id)->days_taken;
         // find the balance after approval
         $balance = $totalAllowedDaysOfLeave - $totalDaysTaken;

         if ($request->approve) {
 
             // check the user's leave type available balance
             $balanceexist = $this->balance->where('leavetype_id', $leave->leavetype_id)->where('user_id', $leave->user_id)->exists();
             if($balanceexist == true){
                 $that_leave = $this->balance->where('leavetype_id', $leave->leavetype_id)->where('user_id', $leave->user_id)->first();
                 $balance1 = $that_leave->balance - $totalDaysTaken;
                 $this->balance->updateOrCreate(['user_id' => $leave->user_id, 'leavetype_id' => $leave->leavetype_id], ['balance' => $balance1]);
             }
             else{
                 // update or create leave balance record in leavebalances table
                 $this->balance->updateOrCreate(['user_id' => $leave->user_id, 'leavetype_id' => $leave->leavetype_id], ['balance' => $balance]);
             }
            
             // set the status of the leave
            $leave->setStatus($this->approvedStatus, 'Leave approved by ' . Auth::user()->name . '<br>Remarks:<br> ' . $request->admin_remarks);
            $leave->user->notify(new ApproveLeave($leave, $leave->user, Auth::user()));
         }
 
         if ($request->reject) {
             // set the status of the leave
             $leave->setStatus($this->rejectedStatus, 'Leave rejected by ' . Auth::user()->name . '<br>Remarks:<br> ' . $request->admin_remarks);
             $leave->user->notify(new RejectLeave($leave, $leave->user, Auth::user()));
         }
 
         if ($request->remarks) {
             // set the status of the leave
             $leave->setStatus($this->submittedStatus, '<b>Remarks by ' . Auth::user()->name . '</b><br>Remarks:<br> ' . $request->admin_remarks);
             $leave->user->notify(new AdminLeaveRemark($leave, $leave->user, Auth::user()));
         } 
        //  dd($leave);
         return \Response::json($leave);
    }

    public function retractLeave(int $id){
          // find leave application
          $leave = $this->leave->find($id);

          // check the user's leave type available balance
          $leavebalance = $this->balance->where('leavetype_id',$leave->leavetype_id)->where('user_id',$leave->user_id)->exists();
          if($leavebalance == true){
              $that_leave = $this->balance->where('leavetype_id', $leave->leavetype_id)->where('user_id', $leave->user_id)->first();
  
              //check if the leave has been approved
              if ($leave->status == $this->approvedStatus) {
                  $that_leave_balance = $that_leave->balance;
                  $that_leave_balance += $leave->days_taken;
                  $that_leave->update([
                      'balance' => $that_leave_balance
                  ]);
              }
          }
  
          $approvers = $leave->approvers->pluck('id')->toArray();
  
          $leave->setStatus($this->withdrawnStatus, 'Leave withdrawn by ' . auth()->user()->name);
  
          $leave->delete();
  
          // notify HR/Administrators
          $this->notifyLeaveApplicationToRecipients($approvers, $leave, new RetractLeave($leave, $leave->user, auth()->user()));
          return \Response::json($leave);
    }

    public function destroy(int $id){
        $user= $this->user->find($id);
      
        $user->claimApprovers()->wherePivot('user_id',$id)->detach();
        $user->leaveApprovers()->wherePivot('user_id',$id)->detach();
        $user->delete();
        return \Response::json($user);
    }

    public function store(Request $request){
        $data = $request->all();        
        if ($request->hasFile('avatar')) {
            $data['avatar'] = $this->uploadAvatar($request);
        }
        $personalDetail = PersonalDetail::updateOrCreate(['user_id' => auth()->id()], $data);
        return \Response::json($data);
    }
    public function uploadAvatar($request)
    {
        $file = $request->file('avatar');
        $filename = time() . $file->getClientOriginalName();
        $file->move('uploads/avatars', $filename);
        return 'uploads/avatars/' . $filename;
    }

    public function editLeave(int $id){
        $leave = $this->leave->find($id);
        $type = $this->type->all();
        $status = $this->leave->find($id)->statuses;
        return \Response::json(['leave'=>$leave,'type'=>$type,'status'=>$status]);
    }
    public function updateLeave(Request $request,$id){
        $leave = Leave::find($id);
        $leave->update([
            'user_id' => $request->user_id,
            'leavetype_id' => $request->leavetype_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'notes' => $request->notes
        ]);
        $this->daySelector($request, $leave);
        $this->saveAttachments($request, $leave);
        return \Response::json($leave);
    }

    //family info
    public function storeFamily(Request $request){
        $family = Family::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'relationship_id' => $request->relationship_id,
            'ic_number' => $request->ic_number,
            'mobile_number' => $request->mobile_number,
            'occupation' => $request->occupation,
            'income_tax_number' => $request->income_tax_number
        ]);
        return \Response::json($family);
    }

    public function showFamily(){
        $familyRecord = $this->familyRecord->with('type','user')->where('user_id', auth()->id())->get();
        return \Response::json($familyRecord);
    }
    public function editFamily(int $id){
        $family = Family::find($id);
        $types = $this->familyType->all();
        return \Response::json(['family'=>$family,'types'=>$types]);
    }
    public function updateFamily(Request $request, $id)
    {
        $family = Family::find($id)->update($request->all());
        return \Response::json($family);
    }
    public function deleteFamily(int $id){
        $family = Family::find($id);
        $family->delete();
        return \Response::json($family);
    }

    //academic info
    public function storeAcademic(Request $request){
        $academic = Academic::create([
            'user_id' => auth()->id(),
            'institution' => $request->institution,
            'study_level' => $request->study_level,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'course' => $request->course,
            'result' => $request->result,
        ]);
        return \Response::json($academic);
    }
    public function showAcademic(){
        $academics = Academic::with('user')->where('user_id', auth()->id())->get();
        return \Response::json($academics);
    }
    public function editAcademic(int $id){
        $academy = Academic::find($id);
        return \Response::json($academy);
    }
    public function updateAcademic(Request $request,$id){
        $academic = Academic::find($id)->update($request->all());
        return \Response::json($academic);
    }
    public function deleteAcademic(int $id){
        $academic = Academic::find($id)->delete();
        return \Response::json($academic);
    }

    //employment info
    public function storeEmployment(Request $request){
        $employment = Experience::create([
            'user_id' => auth()->id(),
            'company' => $request->company,
            'position' => $request->position,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,    
            'description' => $request->description
        ]);
        return \Response::json($employment);
    }
    public function showEmployment(){
        $employment = Experience::with('user')->where('user_id', auth()->id())->get();
        return \Response::json($employment);
    }
    public function editEmployment(int $id){
        $employment = Experience::find($id);
        return \Response::json($employment);
    }
    public function updateEmployment(Request $request,$id){
        $employment = Experience::find($id)->update($request->all());
        return \Response::json($employment);
    }
    public function deleteEmployment(int $id){
        $employment = Experience::find($id)->delete();
        return \Response::json($employment);
    }
    
    //skill info
    public function storeSkill(Request $request){
        $skill = Skill::create([
            'user_id' => auth()->id(),
            'skill' => $request->skill,
            'period' => $request->period
        ]);
        return \Response::json($skill);
    }
    public function showSkill(){
        $skill = Skill::with('user')->where('user_id', auth()->id())->get();
        return \Response::json($skill);
    }
    public function editSkill(int $id){
        $skill = Skill::find($id);
        return \Response::json($skill);
    }
    public function updateSkill(Request $request,$id){
        $skill = Skill::find($id)->update($request->all());
        return \Response::json($skill);
    }
    public function deleteSkill(int $id){
        $skill = Skill::find($id)->delete();
        return \Response::json($skill);
    }

    //award info
    public function storeAward(Request $request){
        $awards = Award::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'received_date' => $request->received_date,
            'notes' => $request->notes,
        ]);
        return \Response::json($awards);
    }
    public function showAward(){
        $awards = Award::with('user')->where('user_id', auth()->id())->get();
        return \Response::json($awards);
    }
    public function editAward(int $id){
        $awards = Award::find($id);
        return \Response::json($awards);
    }
    public function updateAward(Request $request, $id){
        $awards = Award::find($id)->update($request->all());
        return \Response::json($awards);
    }
    public function deleteAward(int $id){
        $awards = Award::find($id)->delete();
        return \Response::json($awards);
    }

    public function leavetypebalance(){

        $types = $this->type->get();
        // dd($types);
        $user = DB::table('leavebalances')->where('user_id',auth()->id())->exists();
        if($user == true){
            $balance = DB::table('leavebalances')->where('user_id',auth()->id())->get();
        
        }

        return \Response::json($balance);
                           
    }
    public function leaveprorated(){
        $today = Carbon::now();
        $month = $today->month;
        $leaveentitle=LeaveEntitlement::where('user_id',auth()->user()->id)->first();
        $day=auth()->user()->leaveEntitlement->days;
       
        $prorated_leave=$day / 12 * $month;
        $available = number_format($prorated_leave);
        $leaveentitle->available_annualleave = $available;
        $leaveentitle->save();

        $balance =LeaveBalance::where('user_id',auth()->user()->id)->where('leavetype_id',7)->exists();
        if($balance == true){
            $b = LeaveBalance::where('user_id',auth()->user()->id)->where('leavetype_id',7)->first();
            $thismonth = $leaveentitle->available_annualleave - ($day - $b->balance);

            if($thismonth <= 0){
                $thismonth = 0 ;
            }

        }else{
            $thismonth = $leaveentitle->available_annualleave;
        }
        return \Response::json($thismonth);
    }
}
