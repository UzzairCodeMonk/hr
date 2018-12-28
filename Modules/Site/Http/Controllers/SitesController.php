<?php

namespace Modules\Site\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Site\Entities\Site;
use DB;
use Datakraf\Traits\AlertMessage;

class SitesController extends Controller
{
    use AlertMessage;
    /**
     * Display a listing of the resource.
     * @return Response
     */
    protected $table = 'siteconfigs';

    public function index()
    {
        return view('site::index', ['site' => DB::table($this->table)->first()]);
    }

    public function store(Request $request)
    {

        $data = $request->all();
        if ($request->hasFile('logo')) {
            $data['logo'] = $this->uploadAvatar($request);
        }
        $siteconfigs = Site::updateOrCreate(['id' => 1], $data);
        toast($this->message('update', 'Site configuration'), 'success', 'top-right');
        return redirect()->back();
    }

    public function uploadAvatar($request)
    {
        $file = $request->file('logo');
        $filename = time() . $file->getClientOriginalName();
        $file->move('sites', $filename);
        return 'sites/' . $filename;
    }


}
