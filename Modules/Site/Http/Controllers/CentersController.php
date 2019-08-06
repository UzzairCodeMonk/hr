<?php

namespace Modules\Site\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Site\Entities\Center;
use Datakraf\Traits\AlertMessage;
use Illuminate\Support\Facades\Validator;
use Modules\Profile\Entities\PersonalDetail;

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

        // $center = Center::create($request->all());
        $codecenter = Center::orderBy('id', 'desc')->first();
        $sub = substr($codecenter->code,1,6);
        $codecenter = 'C' . sprintf("%06d", $sub + 1);
        //check exists ka dak
        $code=Center::where('code',$codecenter)->exists();
        if($code==true){
            $codecenter = 'C' . sprintf("%06d", $sub + 1);
        }
        $center = Center::create(
            [
                'name' => $request->name,
                'code' => $codecenter,
                'address_one' => $request->address_one,
                'address_two' => $request->address_two,
                'postcode' => $request->postcode,
                'city' => $request->city,
                'state' => $request->state,
                'country' => $request->country,
                'mobile_number' => $request->mobile_number,
                'phone_number' =>$request->phone_number,
                'fax_number' => $request->fax_number,
                'email' =>$request->email,
                'status' =>$request->status
            ]
        );
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
                $center = Center::find($id);
                $centerexists = PersonalDetail::where('center_id',$id)->exists();
                if($centerexists == true){
                    toast('Center deleted unsuccessfully. Please remove this following employee from this cost center before deleting', 'error', 'top-right');
                }
                else{
                    $center->holidays()->wherePivot('center_id',$id)->detach();
                    $center->delete();
                    toast('Selected records deleted', 'success', 'top-right');
                }
            // Center::find($id)->delete();
            // toast('Selected records deleted', 'success', 'top-right');
            }  
            // return back();                                      
        }
        else{
        toast('Please select a record before delete', 'error', 'top-right');
        }
        return back();
        
    }
}
