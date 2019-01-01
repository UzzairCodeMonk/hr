<?php

namespace Datakraf\Http\Controllers;

use Illuminate\Http\Request;
use Datakraf\User;
use Datakraf\Traits\AlertMessage;
use Modules\Profile\Entities\Position;
use Datakraf\Http\Requests\CreateEmployeeRequest;
use Modules\Profile\Entities\PersonalDetail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{
    use AlertMessage;
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public $user;
    public $position;
    public $personalDetail;

    public function __construct(User $user, Position $position, PersonalDetail $personalDetail)
    {
        $this->user = $user;
        $this->columnNames = ['name', 'email'];
        $this->actions = [
            'edit' => [
                'url' => 'admin.personal.edit',
                'text' => ucwords('edit'),
                'class' => 'btn btn-link text-dark',
                'id' => ''
            ],

        ];
        $this->deleteAction = [
            'delete' => [
                'url' => 'user.destroy',
                'text' => ucwords('delete'),
                'class' => 'btn btn-link btn-danger text-white',
                'id' => ''
            ]
        ];
        $this->position = $position;
        $this->personalDetail = $personalDetail;

    }

    public function index()
    {

        return view('backend.users.index', [
            'columnNames' => $this->columnNames,
            'datatable' => true,
            'results' => $this->user->all(),
            'actions' => $this->actions,
            'deleteAction' => $this->deleteAction
        ]);
    }

    public function create()
    {
        return view('backend.users.create', ['positions' => $this->position->all()]);
    }
    
    public function edit($id)
    {
        return view('backend.users.create', [
        'user' => $this->user->find($id),
        'positions' => $this->position->all()]);
    }

    public function store(Request $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];
        $user = User::create($data);
        $this->sendCreateUserEmail($data['email']);
        toast('Employee created successfully', 'success', 'top-right');
        return back();
    }


    public function destroy($id)
    {
        $this->user->find($id)->delete();
        toast('Employee deleted successfully', 'success', 'top');
        return back();
    }

    public function sendCreateUserEmail($email)
    {
        Mail::send('emails.master', [
            'title' => 'Welcome!',
            'content' => 'You\'ve been registered to our Human Resource Management System! We hope you enjoy your time with us. Login your account and update your profile.',
            'email' => $email
        ], function ($message) use ($email) {
            $message->from('admin@datakraf.com', 'Datakraf Admin');
            $message->subject('Welcome aboard!');
            $message->to($email);
        });
    }
}
