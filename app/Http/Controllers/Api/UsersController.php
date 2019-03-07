<?php

namespace Datakraf\Http\Controllers\Api;

use Illuminate\Http\Request;
use Datakraf\Http\Controllers\Controller;
use Datakraf\User;


class UsersController extends Controller
{ 
    
    public function index(){

        $users = User::whereHas('personalDetail',function($q){
            $q->where('status','!=', 'resigned');
        })->get();
        
        return response()->json($users, 200);

    }

}
