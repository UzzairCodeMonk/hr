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
            ]);
        }
        toast($this->message('save', 'Employment histroy record(s)'), 'success', 'top-right');
        return redirect()->back();
    }
}
