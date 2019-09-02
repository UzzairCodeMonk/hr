<?php

namespace Datakraf\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use Datakraf\Http\Controllers\Controller;
use Datakraf\User;
use Laravel\Passport\Client;

class RegisterController extends Controller
{
    //
    private $client;

    public function _construct(){
        $this->client = Client::find(1);
    }
    public function register(Request $request){
    $this->validate($request,[
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
    ]);

    $user = User::create([
        'name'=> request('name'),
        'email' => request('email'),
        'password'=>bcrypt('password')
    ]);

    //  $params = [
    //         'grant_type' => 'password',
    //         'client_id' => $this->client->id,
    //         'client_secret' => $this->client->secret,
    //         'username' => request('email'),
    //         'password' => request('password'),
    //         'scope' => '*'
    //     ];

    //     $request->request->add($params);
    //     $proxy = Request::create('oauth/token','POST');
    //     return Route::dispatch($proxy);
    $user->save();        
    return response()->json([
        'message' => 'Successfully created user!'
    ], 201);
    // dd($request->all());
    }
}
