<?php

namespace Modules\Site\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use DB;

class SitesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    protected $table = 'siteconfigs';

    public function index()
    {
        return view('site::index', ['site' => DB::table($this->table)->first()]);
    }

    

}
