<?php

namespace Modules\Profile\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Datakraf\User;
use Modules\Profile\Entities\PersonalDetail;
use Alert;
use Datakraf\Traits\AlertMessage;
use DB;

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

    public function viewEmployeeDetails($id)
    {

        $personalDetail = DB::table('personaldetails')->where('user_id', $id)->first();
        $familyRecord = DB::table('families')->where('user_id', $id)->get();
        $academics = DB::table('academics')->where('user_id', $id)->get();
        $experience = DB::table('experiences')->where('user_id', $id)->get();
        $awards = DB::table('awards')->where('user_id', $id)->get();
        $skills = DB::table('skills')->where('user_id', $id)->get();

        return view('profile::show.master', [
            'personalDetail' => $personalDetail,
            'familyRecord' => $familyRecord,
            'academics' => $academics,
            'experience' => $experience,
            'awards' => $awards,
            'skills' => $skills
        ]);
    }

    public function viewResume($id)
    {
        $personalDetail = DB::table('personaldetails')->where('user_id', $id)->first();
        $position = PersonalDetail::where('user_id',$id)->first()->position->name;
        $familyRecord = DB::table('families')->where('user_id', $id)->get();
        $academics = DB::table('academics')->where('user_id', $id)->get();
        $experience = DB::table('experiences')->where('user_id', $id)->get();
        $awards = DB::table('awards')->where('user_id', $id)->get();
        $skills = DB::table('skills')->where('user_id', $id)->get();

        return view('profile::resumes.one', [
            'personalDetail' => $personalDetail,
            'familyRecord' => $familyRecord,
            'academics' => $academics,
            'experience' => $experience,
            'awards' => $awards,
            'skills' => $skills,
            'position' => $position
        ]);
    }
}
