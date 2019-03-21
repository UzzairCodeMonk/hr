<?php

namespace Datakraf\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Datakraf\Http\Controllers\Controller;
use Datakraf\User;
use Modules\Profile\Entities\PersonalDetail;


class UsersController extends Controller
{

    public function index(Request $request)
    {

        $term = trim($request->q);

        if (empty($term)) {
            return \Response::json([]);
        }

        $users = User::search($term)->limit(5)->get();

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
}
