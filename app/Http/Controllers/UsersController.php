<?php

namespace Datakraf\Http\Controllers;

use Illuminate\Http\Request;
use Datakraf\User;
use Datakraf\Traits\AlertMessage;
use Modules\Profile\Entities\Position;

class UsersController extends Controller
{
    use AlertMessage;
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public $user;
    public $position;

    public function __construct(User $user, Position $position)
    {
        $this->user = $user;
        $this->columnNames = ['name', 'email'];
        $this->actions = [
            'edit' => [
                'url' => 'leave-type.edit',
                'text' => ucwords('edit'),
                'class' => 'btn btn-link text-dark',
                'id' => ''
            ]
        ];
        $this->deleteAction = [
            'delete' => [
                'url' => 'leave-type.destroy',
                'text' => ucwords('delete'),
                'class' => 'btn btn-link btn-danger text-white',
                'id' => ''
            ]
        ];
        $this->position = $position;

    }

    public function index()
    {

        return view('backend.users.index', ['columnNames' => $this->columnNames, 'datatable' => true, 'results' => $this->user->all(), 'actions' => $this->actions, 'deleteAction' => $this->deleteAction]);
    }

    public function create()
    {
        return view('backend.users.create', ['positions'=>$this->position->all()]);
    }
}
