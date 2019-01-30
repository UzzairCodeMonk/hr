<?php

namespace Datakraf\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Modules\Profile\Entities\PersonalDetail;
use Datakraf\User;

class DemoController extends Controller
{   
    /**
     * To handle the coming post request
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveJqueryImageUpload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'profile_picture' => 'required|image|max:1000',
        ]);

        if ($validator->fails()) {
            
            return $validator->errors();            
        }

        $status = "";

        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            // Rename image
            $filename = time().'.'.$image->guessExtension();
            
            // $path = $request->file('profile_picture')->storeAs(
            //      'profile_pictures', $filename
            // );
            $image->move('uploads/avatars', $filename);
            $id = auth()->id();
            PersonalDetail::where('user_id',$id)->update([
                'avatar' => 'uploads/avatars/' . $filename
            ]);

            $status = "uploaded";
        }
        
        return response($status,200);
    }
}
