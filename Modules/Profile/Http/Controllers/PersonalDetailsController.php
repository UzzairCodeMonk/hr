<?php

namespace Modules\Profile\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Datakraf\User;
use Modules\Profile\Entities\PersonalDetail;
use Alert;
use Datakraf\Traits\AlertMessage;

class PersonalDetailsController extends Controller
{
    use AlertMessage;

    protected $personalDetail;

    public function __construct(PersonalDetail $personalDetail)
    {
        $this->personalDetail = $personalDetail;
    }

    /**
     * fetch personal details
     *
     * @return void
     */
    public function index()
    {
        $personalDetail = $this->personalDetail->where('user_id', auth()->id())->first();
        return view('profile::forms.personal-details.personal-details', compact('personalDetail'));
    }

    /**
     * Create or Update personal details
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $data = $request->all();        
        PersonalDetail::updateOrCreate(['user_id' => auth()->id()], $data);
        toast($this->message('save', 'Personal detail record'), 'success', 'top-right');
        return redirect()->back();
    }
}
