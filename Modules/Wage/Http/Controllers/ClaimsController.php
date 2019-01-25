<?php

namespace Modules\Wage\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Wage\Entities\Claim;
use Modules\Wage\Entities\ClaimType;
use Modules\Wage\Entities\ClaimAttachment;

class ClaimsController extends Controller
{

    public function __construct(Request $request, Claim $claim, ClaimType $type, ClaimAttachment $attachment)
    {
        $this->data = [
            'user_id' => $request->user_id,
            'claimtype_id' => $request->claimtype_id,
            'date' => $request->date,
            'remarks' => $request->remarks
        ];
        $this->claim = $claim;
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
        $claim = $this->claim->create($this->data);

        $this->saveAttachments($request, $claim);

        toast('Claim submitted successfully', 'success', 'top-right');
        return redirect()->back();


    }

    public function saveAttachments($request, $claim)
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
                        'claim_id' => $claim->id,
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
    public function show()
    {
        return view('wage::show');
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
    {
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
}
