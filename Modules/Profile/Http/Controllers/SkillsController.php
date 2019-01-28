<?php

namespace Modules\Profile\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Datakraf\Traits\Crudable;
use Datakraf\Traits\AlertMessage;
use Modules\Profile\Entities\Skill;
use Modules\Profile\Http\Requests\CreateSkillsRequest;

class SkillsController extends Controller
{
    use Crudable, AlertMessage;

    protected $skill;

    public function __construct(Skill $skill)
    {
        $this->skill = $skill;
    }

    public function index()
    {
        $skills = $this->skill->where('user_id', auth()->id())->get();
        return view('profile::forms.personal-details.skills', compact('skills'));
    }

    public function store(CreateSkillsRequest $request)
    {

        $this->skill->create([
            'user_id' => auth()->id(),
            'skill' => $request->skill,
            'period' => $request->period
        ]);
        toast($this->message('save', 'Skill record(s)'), 'success', 'top-right');
        return redirect()->back();
    }

    public function edit($id)
    {
        $skill = Skill::find($id);
        $skills = $this->skill->where('user_id', auth()->id())->get();
        return view('profile::forms.personal-details.skills', compact('skills', 'skill'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(CreateSkillsRequest $request, $id)
    {
        Skill::find($id)->update($request->all());
        toast($this->message('update', 'Skill record'), 'success', 'top-right');
        return redirect()->route('skill.index');
    }

    public function destroy(Request $request)
    {
        $ids = $request->ids;
        if (count($ids) > 0) {
            foreach ($ids as $id) {
                Skill::find($id)->delete();
            }
            toast('Selected records deleted', 'success', 'top-right');
            return back();
        }
        toast('Please select a record before delete', 'error', 'top-right');
        return back();

    }

}
