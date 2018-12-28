<?php

namespace Modules\Profile\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Profile\Entities\Experience;
use Datakraf\Traits\AlertMessage;
use Datakraf\Traits\Crudable;

class ExperiencesController extends Controller
{

    use Crudable, AlertMessage;

    protected $experience;

    public function __construct(Experience $experience)
    {
        $this->experience = $experience;
    }

    public function index()
    {
        $experience = $this->experience->where('user_id', auth()->id())->get();
        return view('profile::forms.personal-details.experience', compact('experience'));
    }

    public function store(Request $request)
    {
        for ($i = 0; $i < count($request->company); ++$i) {
            Experience::create([
                'user_id' => auth()->id(),
                'company' => $request->company[$i],
                'position' => $request->position[$i],
                'start_date' => $request->start_date[$i],
                'end_date' => $request->end_date[$i],    
                'description' => $request->description[$i]
            ]);
        }
        toast($this->message('save', 'Employment histroy'), 'success', 'top-right');
        return redirect()->back();
    }

    public function edit($id)
    {   $expPersonal = Experience::find($id);
        $experience = $this->experience->where('user_id', auth()->id())->get();
        return view('profile::forms.personal-details.experience', compact('experience','expPersonal'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
        Experience::find($id)->update($request->all());
        toast($this->message('update', 'Employment history'), 'success', 'top-right');
        return redirect()->route('experience.index');
    }
}
