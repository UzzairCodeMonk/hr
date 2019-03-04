<?php

namespace Modules\Leave\Repository;

use Datakraf\User;
use Uzzaircode\DateHelper\Traits\DateHelper;

class LeaveRepository{

    public function getUserStatus(int $id): string
    {
        return User::find($id)->personalDetail->status;
    }

   
}