<?php

namespace Modules\Profile\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Datakraf\Traits\Crudable;
use Modules\Profile\Entities\Family;
use Datakraf\User;
use Alert;
use Datakraf\Traits\AlertMessage;
use Modules\Profile\Entities\FamilyType;

class FamiliesController extends Controller
{
    use Crudable, AlertMessage;

    protected $familyRecord;
    protected $familyType;

    public function __construct(Family $familyRecord,FamilyType $type)
    {
        $this->familyRecord = $familyRecord;
        $this->type = $type;
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $familyRecord = $this->familyRecord->where('user_id', auth()->id())->get();
        $types = $this->type->all();
        return view('profile::forms.personal-details.family-details', compact('familyRecord','types'));
    }
    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        for ($i = 0; $i < count($request->name); ++$i) {
            Family::create([
                'user_id' => auth()->id(),
                'name' => $request->name[$i],
                'relationship_id' => $request->relationship_id[$i],
                'ic_number' => $request->ic_number[$i],
                'mobile_number' => $request->mobile_number[$i],
                'occupation' => $request->occupation[$i],
                'income_tax_number' => $request->income_tax_number[$i]
            ]);
        }
        toast($this->message('save', 'Family record'), 'success', 'top-right');
        return redirect()->back();

    }


    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('profile::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('profile::edit');
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
    public function destroy()
    {
    }
}
