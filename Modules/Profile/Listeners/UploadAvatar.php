<?php

namespace Modules\Profile\Listeners;

use Modules\Profile\Events\PersonalDetailCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;
use Auth;

class UploadAvatar
{
    public $personalDetail;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(PersonalDetail $personalDetail)
    {
        $this->personalDetail = $personalDetail;
    }

    /**
     * Handle the event.
     *
     * @param PersonalDetailCreated $event
     * @return void
     */
    public function handle(PersonalDetailCreated $event)
    {
        $userDir = $this->findOrCreateUserDirectory();    
        if ($event->request->hasFile('avatar')) {
            $file = $event->request->file('avatar');                
               // save the attachment with event title and time as prefix
            $filename = time() . $file->getClientOriginalName();
                  
               // move the attachements to public/uploads/users/useridusername folder
            $file->storeAs($userDir, $filename);
        }
        $this->personalDetail->find('user_id', 2)->first()->update([
            'avatar' => $filename
        ]);
    }

    public function findOrCreateUserDirectory()
    {
        $userDirName = str_replace(' ','',Auth::id() . Auth::user()->name);
        $userDir = 'users/' . $userDirName;
        if (!Storage::disk('public')->exists($userDir)) {
            Storage::disk('public')->makeDirectory($userDir);
        }
        return $userDir;
    }
}
