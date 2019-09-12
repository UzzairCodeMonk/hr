<?php

namespace Datakraf\Http\Controllers\Api\Auth;

// use App\Http\Controllers\Api\Auth\IssueTokenTrait;
use Datakraf\Traits\IssueTokenTrait;
use Illuminate\Http\Request;
use Datakraf\Http\Controllers\Controller;
use DB;
use Auth;
use Laravel\Passport\Client;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;

class LoginController extends Controller
{

    use IssueTokenTrait;
    private $client;

    public function _construct(){
        $this->client = Client::findOrFail(1);
    }
    //
    public function login(Request $request){
        $this->validate($request,[
            'email' => 'required',
            'password' => 'required',
        ]);
        // $params = [
        //     'grant_type' => 'password',
        //     'client_id' => $this->client->id,
        //     'client_secret' => $this->client->secret,
        //     'username' => request('username'),
        //     'password' => request('password'),
        //     'scope' => '*'
        // ];

        // $request->request->add($params);
        // $proxy = Request::create('oauth/token','POST');
        // return Route::dispatch($proxy);
        // return $this->issueToken($request,'password');
        $credentials = request(['email', 'password']);        
        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);        
            $user = $request->user();        
            $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;        
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);        
            $token->save();        
            return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString(),
            'email'=>request('email'),
            'password'=>request('password'),
        ]);

    }

    public function refresh(Request $request){
        $this->validate($request,[
            'refresh_token' => 'required'
        ]);
        // $params = [
        //     'grant_type' => 'refresh_token',
        //     'client_id' => $this->client->id,
        //     'client_secret' => $this->client->secret,
        //     'username' => request('username'),
        //     'password' => request('password'),
        // ];

        // $request->request->add($params);
        // $proxy = Request::create('oauth/token','POST');
        // return Route::dispatch($proxy);
        return $this->issueToken($request,'refresh_token');
    }
    public function logout(Request $request){
        // $accessToken = Auth::user()->token();

        // DB::table('oauth_refresh_tokens')
        //  ->where('access_token_id',$accessToken->id)
        //  ->update(['revoked'=> true]);

        //  $accessToken->revoke();
        //  return response()->json([],204);
        $request->user()->token()->revoke();        
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }


}
