<?php

namespace Modules\Profile\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Profile\Entities\PersonalDetail;
use Illuminate\Http\Request;
use Datakraf\Events\UserUpdated;

class UpdatePersonalDetail
{
    public $personalDetail;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(PersonalDetail $personalDetail, Request $request)
    {
        $this->personalDetail = $personalDetail;
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param UserCreated $event
     * @return void
     */
    public function handle(UserUpdated $event)
    {
        $this->personalDetail->where('user_id',$event->user->id)->update([            
            'name' => $event->user->name,
            'ic_number' => $this->request->ic_number,
            'staff_number' => $this->request->staff_number,
            'socso_id' => $this->request->socso_id,
            'epf_id' => $this->request->epf_id,
            'position_id' => $this->request->position_id,
            'status' => $this->request->status,
        ]);
    }
}
