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
        for ($i = 0; $i < count($request->name); ++$i) {
            $this->award->create([
                'user_id' => auth()->id(),
                'name' => $request->name[$i],
                'received_date' => $request->received_date[$i],
                'notes' => $request->notes[$i],                
            ]);
        }
        toast($this->message('save', 'Award record(s)'), 'success', 'top-right');
        return redirect()->back();
    }

    public function edit($id)
    {   
        $awards = $this->award->where('user_id', auth()->id())->get();
        $award = Award::find($id);
        return view('profile::forms.personal-details.awards', compact('awards','award'));
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

}
