<?php

namespace Modules\Profile\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Datakraf\Traits\Crudable;
use Datakraf\Traits\AlertMessage;
use Modules\Profile\Entities\Skill;

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

    public function store(Request $request)
    {
        for ($i = 0; $i < count($request->skill); ++$i) {
            $this->skill->create([
                'user_id' => auth()->id(),
                'skill' => $request->skill[$i],
                'period' => $request->period[$i]
            ]);
        }
        toast($this->message('save', 'Skill record(s)'), 'success', 'top-right');
        return redirect()->back();
    }

    public function edit($id)
    {
        $skill = Skill::find($id);
        $skills = $this->skill->where('user_id', auth()->id())->get();
        return view('profile::forms.personal-details.skills', compact('skills','skill'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
        Skill::find($id)->update($request->all());
        toast($this->message('update', 'Skill record'), 'success', 'top-right');
        return redirect()->route('skill.index');
    }

}
