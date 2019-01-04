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
use Datakraf\Notifications\UserCreatedNotification;
use Spatie\Permission\Models\Role;

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

    public function __construct(User $user, Position $position, PersonalDetail $personalDetail, Role $role)
    {
        $this->user = $user;
        $this->role = $role;
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
        return view('backend.users.create', ['positions' => $this->position->all(), 'roles' => $this->role->all()]);
    }

    public function edit($id)
    {
        return view('backend.users.create', [
            'user' => $this->user->find($id),
            'positions' => $this->position->all(),
            'roles' => $this->role->all()
        ]);
    }

    public function store(Request $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];
        $user = User::create($data);
        $user->assignRole($request->role);
        $user->notify(new UserCreatedNotification());
        toast('Employee created successfully', 'success', 'top-right');
        return back();
    }

    public function update(Request $request,$id)
    {
        $user = User::updateOrCreate(['id'=>$id],[
            'name' => $request->name,
            'email' => $request->email,
        ]);
        if(!empty($request->password)){
            $user->password = Hash::make($request->password);
            $user->save();
        }
        // $user = User::updateOrCreate(['id' => $id], $data);
        $user->assignRole($request->role);
        toast('Employee information updated successfully', 'success', 'top-right');
        return back();
    }

    public function destroy($id)
    {
        $this->user->find($id)->delete();
        toast('Employee deleted successfully', 'success', 'top');
        return back();
    }

}
