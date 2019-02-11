<?php

namespace Modules\Leave\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Site\Entities\Center;
use DB;
use Datakraf\Day;

class ConfigsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('leave::leave.configs.index',[
            'centers' => Center::all(),
            'days' => DB::table('days')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('leave::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $center = Center::find($request->center_id);
        $days = Day::find($request->days);        
        $center->holidays()->sync($days);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('leave::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('leave::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
