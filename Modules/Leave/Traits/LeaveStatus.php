<?php 

namespace Modules\Leave\Traits;

trait LeaveStatus
{

    protected $approvedStatus = 'approved';
    protected $rejectedStatus = 'rejected';
    protected $submittedStatus = 'submitted';
    protected $withdrawnStatus = 'withdrawn';
    protected $remarkStatus = 'remarks';

}