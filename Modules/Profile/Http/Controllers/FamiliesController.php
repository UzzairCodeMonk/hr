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
use Datakraf\Http\Requests\BulkDeleteRequest;
use Modules\Profile\Http\Requests\CreateFamilyRequest;

class FamiliesController extends Controller
{
    use Crudable, AlertMessage;

    protected $familyRecord;
    protected $familyType;

    public function __construct(Family $familyRecord, FamilyType $type)
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
        return view('profile::forms.personal-details.family-details', compact('familyRecord', 'types'));
    }
    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(CreateFamilyRequest $request)
    {

        Family::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'relationship_id' => $request->relationship_id,
            'ic_number' => $request->ic_number,
            'mobile_number' => $request->mobile_number,
            'occupation' => $request->occupation,
            'income_tax_number' => $request->income_tax_number
        ]);

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
    public function edit($id)
    {
        $family = Family::find($id);
        $familyRecord = $this->familyRecord->where('user_id', auth()->id())->get();
        $types = $this->type->all();
        return view('profile::forms.personal-details.family-details', compact('familyRecord', 'types', 'family'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
        Family::find($id)->update($request->all());
        toast($this->message('update', 'Family record'), 'success', 'top-right');
        return redirect()->route('family.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(BulkDeleteRequest $request)
    {

        $ids = $request->ids;
        foreach ($ids as $id) {
            Family::find($id)->delete();
        }
        toast('Selected records deleted', 'success', 'top-right');
        return back();

    }


    public function adminEdit($id)
    {

        $family = $this->familyRecord->where('user_id', $id)->get();
        return view('profile::forms.edit.family', ['familyRecord' => $family, 'types' => $this->type->all()]);
    }
}
