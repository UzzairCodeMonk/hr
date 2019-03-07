<?php

namespace Datakraf\Http\Controllers;

use Illuminate\Http\Request;

class DashboardsController extends Controller
{
    
    public function index()
    {

        return view('backend.admin.dashboard');

    }

}
