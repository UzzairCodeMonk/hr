<?php

namespace Datakraf\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Modules\Leave\Entities\Leave;

class LeaveRequests extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //
        $count = Leave::currentStatus('submitted')->count();

        return view('widgets.leave_requests', [
            'config' => $this->config,
            'count' => $count,
            'link' => route('user.index'),
            'class' => 'btn-secondary',
            'text' => 'View'
        ]);
    }
}
