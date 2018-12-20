<?php

namespace Modules\Profile\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Datakraf\User;
use Auth;
use Modules\Profile\Http\Requests\ResetPasswordRequest;
use Illuminate\Support\Facades\Hash;
use Alert;
use Illuminate\Support\Facades\Validator;

class SecuritiesController extends Controller
{

    public $user;

    public function ___construct(User $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        return view('profile::forms.security.index');
    }

    public function resetPassword(Request $request)
    {
        $validators = Validator::make($request->all(), [
            'password' => 'required|min:8|confirmed',            
        ]);
        if ($validators->fails()) {
            return redirect()->back()
                ->withErrors($validators)
                ->withInput();
        } else {
            User::where('id', Auth::id())->first()->update([
                'password' => Hash::make($request->password)
            ]);
            toast('Your password was changed successfully. Please login again with the new password.', 'success', 'top');
            Auth::logout();
            return redirect('/login');
        }

    }

    public function validatePassword($request)
    {

    }

}
