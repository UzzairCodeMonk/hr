<?php
namespace Datakraf\Traits;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

trait IssueTokenTrait{

    public function issueToken(Request $request,$grantType, $scope = "*"){
        if($this->client != null){
        $params = [
            'grant_type' => $grantType,
            'client_id' => $this->client->id,
            'client_secret' => $this->client->secret,
            'username' => $request->email,
            'scope' => $scope
        ];
    }else{
        $params = [
            'grant_type' => $grantType,
            'client_id' => null,
            'client_secret' => null,           
            'scope' => $scope
        ];
    }

        $request->request->add($params);
        $proxy = Request::create('oauth/token','POST');
        return Route::dispatch($proxy);

    }
}

