<?php

namespace Modules\Site\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Site\Entities\Center;
use Datakraf\Traits\AlertMessage;
use Illuminate\Support\Facades\Validator;

class CentersController extends Controller
{
    use AlertMessage;


    public function index(){

        return view('site::company.index',[
            'centers' => Center::all()
        ]);

    }
    
    public function create(){

        return view('site::company.form');

    }

    public function edit(int $id){

        return view('site::company.form',[
            'center' => Center::find($id)
        ]);

    }

    public function store(Request $request){      

        $center = Center::create($request->all());
        toast($this->message('save', 'Cost Center'), 'success', 'top-right');
        return redirect()->route('company.index');
    }


    public function update(int $id, Request $request ){
        if($request->email){
            $validator = Validator::make($request->all(), [
                'email' => 'email',
            ], [
                'email.email' => 'It should be in email format',
            ]);
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
        }
        Center::find($id)->update($request->all());
        toast($this->message('update', 'Cost Center'), 'success', 'top-right');
        return redirect()->route('company.index');

    }


    public function destroy(Request $request){

        $ids = $request->ids;

        if (count($ids)) {                     
            foreach ($ids as $id) {
            Center::find($id)->delete();
            toast('Selected records deleted', 'success', 'top-right');
            return back();
            }                                         
        }
        toast('Please select a record before delete', 'error', 'top-right');
        return back();
        
    }
}
