<?php

namespace Datakraf\Widgets;

use Arrilot\Widgets\AbstractWidget;
use Datakraf\User;

class TotalEmployees extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];
    public $reloadTimeout = 10;

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //
        $users = User::count();
        return view('widgets.total_employees', [
            'config' => $this->config,
            'count' => $users,
            'link' => route('user.index'),
            'class' => 'btn-secondary',
            'text' => 'View'
        ]);
    }
}
