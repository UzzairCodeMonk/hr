<?php

namespace Modules\Profile\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Profile\Entities\PersonalDetail;
use Illuminate\Http\Request;
use Datakraf\Events\UserUpdated;

class UpdatePersonalDetailOnUserUpdate
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
     * @param UserUpdated $event
     * @return void
     */
    public function handle(UserUpdated $event)
    {
        $p = $this->personalDetail->where('user_id', $event->user->id)->first();
        // dd($p);
        $p->name = $event->user->name;
        $p->ic_number = $this->request->ic_number;
        $p->staff_number = $this->request->staff_number;
        $p->socso_id = $this->request->socso_id;
        $p->epf_id = $this->request->epf_id;
        $p->position_id = $this->request->position_id;
        $p->status = $this->request->status;
        $p->save();



    }
}
