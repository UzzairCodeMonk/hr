<?php

namespace Modules\Profile\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Datakraf\Traits\Crudable;
use Datakraf\Traits\AlertMessage;
use Modules\Profile\Entities\Academic;
use Modules\Profile\Http\Requests\CreateAcademicsRequest;

class AcademicsController extends Controller
{
    use Crudable, AlertMessage;

    protected $academic;

    public function __construct(Academic $academic)
    {
        $this->academic = $academic;
    }

    public function index()
    {
        $academics = $this->academic->where('user_id', auth()->id())->get();
        return view('profile::forms.personal-details.academic', compact('academics'));
    }

    public function store(CreateAcademicsRequest $request)
    {
        Academic::create([
            'user_id' => auth()->id(),
            'institution' => $request->institution,
            'study_level' => $request->study_level,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'course' => $request->course,
            'result' => $request->result,
        ]);
        toast($this->message('save', 'Academic record(s)'), 'success', 'top-right');
        return redirect()->back();
    }



    public function edit($id)
    {
        $academics = $this->academic->where('user_id', auth()->id())->get();
        $academy = Academic::find($id);
        return view('profile::forms.personal-details.academic', compact('academics', 'academy'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(CreateAcademicsRequest $request, $id)
    {
        Academic::find($id)->update($request->all());
        toast($this->message('update', 'Academic record'), 'success', 'top-right');
        return redirect()->route('academic.index');
    }

    public function destroy(Request $request)
    {

        $ids = $request->ids;
        foreach ($ids as $id) {
            Academic::find($id)->delete();
        }
        toast('Selected records deleted', 'success', 'top-right');
        return back();

    }

}
