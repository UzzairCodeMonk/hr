<?php

namespace Modules\Profile\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Datakraf\Traits\Crudable;
use Datakraf\Traits\AlertMessage;
use Modules\Profile\Entities\Award;

class AwardsController extends Controller
{
    use Crudable, AlertMessage;

    protected $award;

    public function __construct(Award $award)
    {
        $this->award = $award;
    }

    public function index()
    {
        $awards = $this->award->where('user_id', auth()->id())->get();
        return view('profile::forms.personal-details.awards', compact('awards'));
    }

    public function store(Request $request)
    {
        $this->award->create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'received_date' => $request->received_date,
            'notes' => $request->notes,
        ]);
        toast($this->message('save', 'Award record(s)'), 'success', 'top-right');
        return redirect()->back();
    }

    public function edit($id)
    {
        $awards = $this->award->where('user_id', auth()->id())->get();
        $award = Award::find($id);
        return view('profile::forms.personal-details.awards', compact('awards', 'award'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
        Award::find($id)->update($request->all());
        toast($this->message('update', 'Award record'), 'success', 'top-right');
        return redirect()->route('award.index');
    }

    public function destroy(Request $request)
    {

        $ids = $request->ids;
        foreach ($ids as $id) {
            Award::find($id)->delete();
        }
        toast('Selected records deleted', 'success', 'top-right');
        return back();

    }

}
