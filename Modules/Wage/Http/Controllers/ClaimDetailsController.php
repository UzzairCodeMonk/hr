<?php

namespace Modules\Wage\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Wage\Entities\ClaimType;
use Modules\Wage\Entities\ClaimAttachment;
use Datakraf\Notifications\SubmitClaimToAdminNotification;
use Modules\Wage\Entities\ClaimDetail;
use Modules\Wage\Entities\Claim;
use Auth;
use Datakraf\User;
use DB;
use URL;
use PDF;

class ClaimDetailsController extends Controller
{
    protected $approvedStatus = 'approved';
    protected $rejectedStatus = 'rejected';
    protected $submittedStatus = 'submitted';
    protected $retractedStatus = 'withdrawn';
    protected $remarkStatus = 'remarks';

    public function __construct(Request $request, Claim $claim, ClaimType $type, ClaimAttachment $attachment, ClaimDetail $detail)
    {
        $this->data = [
            'claim_id' => $request->claim_id,
            'claimtype_id' => $request->claimtype_id,
            'amount' => $request->amount,
            'date' => $request->date,
            'remarks' => $request->remarks
        ];
        $this->claim = $claim;
        $this->detail = $detail;
        $this->type = $type;
        $this->attachment = $attachment;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('wage::claims.apply', [
            'types' => $this->type->all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('wage::claim');
    }

    public function claimRecords()
    {
        return view('wage::claims.admin.all-records', [
            'claims' => $this->claim->orderBy('created_at', 'desc')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'attachments' => 'required'
        ]); 
        $claimdetail = $this->detail->create($this->data);

        $this->saveAttachments($request, $claimdetail);

        $this->calculateClaimTotal($claimdetail);

        toast('Claim detail saved successfully', 'success', 'top-right');
        return redirect()->back();
    }

    public function sendCheck($request, $claim)
    {
        if ($request->has('send')) {
            $this->notifyHR($claim, new SubmitClaimToAdminNotification($claim, Auth::user()));
            $claim->status = 1;
            $claim->save;
            toast('Claim submitted successfully', 'success', 'top-right');
        }
    }

    /**
     * Notify HR Administrators
     * 
     * @param object $claim
     * @param object $notification
     * 
     */
    public function notifyHR($notification)
    {
        $admins = User::whereHas('roles', function ($q) {
            $q->where('name', 'Admin');
        })->get();

        foreach ($admins as $admin) {
            $admin->notify($notification);
        }
    }

    public function saveAttachments($request, $claimdetail)
    {
        if ($request->hasFile('attachments')) {

            foreach ($request->file('attachments') as $file) {
                if (!empty($file)) {
                    // save the attachment with event title and time as prefix
                    $filename = time() . $file->getClientOriginalName();
                    // move the attachements to public/uploads/applicationsattachments folder
                    $file->move('uploads/claimattachments', $filename);
                    // create attachement record in database, attach it to Ticket ID
                    $this->attachment->create([
                        'claim_id' => $claimdetail->claim_id,
                        'claim_detail_id' => $claimdetail->id,
                        'filename' => $filename,
                        'filepath' => 'uploads/claimattachments/' . $filename,
                        'claimdetail_id' => 0,
                    ]);
                }
            }
        }
    }
    /**
     * Show the specified resource.
     * @return Response
     */

    public function show($id)
    {
        if($this->claim->where('id',$id)->exists()==true){
        $cs=$this->claim->find($id);
        $ss = false;
        $statusexist = DB::table('statuses')->where('model_id',$id)->where('model_type','=','Modules\Wage\Entities\Claim')->exists();
      
        if($statusexist == true){
            foreach($cs->statuses as $status){
                if($status->name=='remarks'){
                    $ss = true;
                }
            }
        }
       
        $approver = DB::table('claimapprover_user')->where('approver_id',Auth::user()->id)->exists();
        $ap = false;
        if($approver == true){
            $appro = DB::table('claimapprover_user')->where('approver_id',Auth::user()->id)->get();
          
            foreach($appro as $app){
                $appr = $app->approver_id;
                $ap = true;
            }
        }
        // determine if action buttons will be displayed or vice versa
        $actionVisibility = !in_array($this->claim->find($id)->status, [$this->approvedStatus, $this->rejectedStatus, $this->remarkStatus]);
        return view('wage::claims.show', [

            'claim' => $this->claim->find($id),
            'detail' => $this->claim->details,
            'actionVisibility' => $actionVisibility,
            'ss' => $ss,
            'ap' =>$ap,

        ]);
        }else{
            toast('Claim has been deleted by user','top-right');
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
         // dd($this->claim->details);
         $claim_id = $this->detail->where('id',$id)->first()->claim_id;
         // dd($claim_id);
         $claim_subject= $this->claim->find($claim_id)->subject;
         return view('wage::claims.editclaim', [
            'detail' => $this->detail->find($id),
            'types' => $this->type->all(),
            'statuses' => $this->claim->find($claim_id)->statuses,
            'claim_id' => $claim_id,
            'claim_subject' => $claim_subject,
        ]);
    }

    //updatedetail masa edit balik
    public function updateclaim(Request $request, $id){
        $claim = ClaimDetail::where('id',$id)->first();
        $claim_id = ClaimDetail::where('id', $id)->first()->claim_id;

        $claim->update($this->data);

        $this->saveAttachments($request, $claim);

        toast('Claim detail updated successfully', 'success', 'top-right');
        // return redirect()->back();
        return redirect(URL::signedRoute('claim.editClaim', ['id' => $claim_id]));

    }
    //deletedetail masa edit balik
    public function deletedetail($id)
    {
        $this->detail->find($id)->delete();

        toast('Claim detail deleted successfully', 'success', 'top-right');
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        dd($request->all());
        $id = $request->pk;
        $key = $request->name;
        $value = $request->value;

        $cd = ClaimDetail::findOrFail($id);
        $cd->update([$key => $value]);
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $this->claim->find($id)->delete();

        toast('Claim deleted successfully', 'success', 'top-right');
        return redirect()->back();
    }

    public function showMyClaims()
    {

        return view('wage::claims.admin.all-records', [
            'claims' => $this->claim->where('user_id', auth()->id())->orderBy('created_at', 'desc')->get(),
        ]);
    }

    public function calculateClaimTotal($claimdetail)
    {

        $claim = ClaimDetail::where('claim_id', '=', $claimdetail->claim_id)->pluck('amount');
        $claimTotal = collect($claim)->sum();

        Claim::find($claimdetail->claim_id)->update([
            'amount' => $claimTotal
        ]);
    }
    //show user auth
    public function showAuth($id)
    {
        return view('wage::claims.showAuth', [

            'claim' => $this->claim->find($id),
            'detail' => $this->claim->details,
        ]);
    }
    //export pdf individu
    public function exportPDFclaim($id)
    {
        $claim = Claim::find($id);
        // Fetch all customers from database
        // $data = PayslipSummary::get();
        // Send data to the view using loadView function of PDF facade
        $pdf = PDF::loadView('wage::claims.claim-pdf', compact('claim'))->setPaper('a4','potrait');
        // If you want to store the generated pdf to the server then you can use the store function
        // $pdf->save(storage_path('app\public\form'.'claim-detail.pdf'));
        // Finally, you can download the file using download function
        return $pdf->download('claim-detail.pdf');
    }
}
