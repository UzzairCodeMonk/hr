<?php

namespace Datakraf\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Datakraf\Http\Controllers\Controller;
use Datakraf\User;
use Modules\Profile\Entities\PersonalDetail;
use Auth;

class UsersController extends Controller
{

    public function index(Request $request)
    {

        $term = trim($request->q);

        if (empty($term)) {
            return \Response::json([]);
        }

        $users = User::search($term)->whereHas('personalDetail', function ($q) {
            $q->where('status', '!=', 'resigned');
        })->limit(5)->get();

        $formatted_users = [];

        foreach ($users as $user) {
            $formatted_users[] = ['id' => $user->id, 'text' => $user->name];
        }

        return \Response::json($formatted_users);
    }

    public function fetchGenderStats()
    {
        $users = collect(PersonalDetail::all());

        $genders = array_count_values($users->pluck('gender')->toArray());

        $genders = collect($genders)->values()->toArray();

        return \Response::json($genders);
    }

    public function fetchLeaveApprovers($id){

        $users = User::find($id)->leaveApprovers()->get();

        return \Response::json($users);
    }

    public function fetchClaimApprovers($id){

        $users = User::find($id)->claimApprovers()->get();

        return \Response::json($users);
    }
}
