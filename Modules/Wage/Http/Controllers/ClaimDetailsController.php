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

class ClaimDetailsController extends Controller
{

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
        $claimdetail = $this->detail->create($this->data);
        
        $this->saveAttachments($request, $claimdetail);
        
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
    public function notifyHR($claim, $notification)
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
                        'claimdetail_id' =>$claimdetail->id,
                        'filename' => $filename,
                        'filepath' => 'uploads/claimattachments/' . $filename
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
        return view('wage::claims.show', [
            'claim' => $this->claim->find($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('wage::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    { }

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
}
