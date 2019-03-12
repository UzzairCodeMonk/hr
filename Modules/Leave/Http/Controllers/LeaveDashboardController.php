<?php

namespace Modules\Leave\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class LeaveDashboardController extends Controller
{
   public function index(){

    return view('leave::leave.admin.dashboard');
    
   }
}
