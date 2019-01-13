<?php

namespace Datakraf\Http\Controllers;

use Illuminate\Http\Request;
use Datakraf\User;
use Datakraf\Traits\AlertMessage;
use Modules\Profile\Entities\Position;
use Modules\Profile\Entities\PersonalDetail;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Datakraf\Traits\Roleable;
use DB;
use File;
use Illuminate\Support\Facades\Mail;
use Datakraf\Traits\ApiRequestable;
use Datakraf\Http\Requests\CreateEmployeeRequest;

class UsersController extends Controller
{
    use AlertMessage, Roleable, ApiRequestable;
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
            'results' => $this->user->has('personalDetail')->get(),
            'actions' => $this->actions,
            'deleteAction' => $this->deleteAction
        ]);
    }

    public function create()
    {
        return view('backend.users.form', [
            'positions' => $this->position->all(),
            'roles' => $this->role->pluck('name', 'id'),
            'banks' => DB::table('banks')->get(),
        ]);
    }

    public function edit($id)
    {
        return view('backend.users.form', [
            'user' => $this->user->find($id),
            'positions' => $this->position->all(),
            'roles' => $this->role->pluck('name', 'id'),
            'banks' => DB::table('banks')->get()
        ]);
    }

    public function store(CreateEmployeeRequest $request)
    {

        // $this->validate($request, [
        //     'name' => 'bail|required|min:2',
        //     'email' => 'required|email|unique:users,email',
        //     'roles' => 'required|min:1',
        //     'socso_id' => 'required',
        //     'epf_id' => 'required',
        //     'status' => 'required',
        //     'staff_number' => 'required',
        //     'password' => 'required|confirmed|min:6',
        //     'join_date' => 'required',
        //     'bank_id' => 'required',
        //     'account_number' => 'required',
        //     'basic_salary' => 'required'
        // ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->role);
        toast('Employee created successfully', 'success', 'top-right');
        return back();
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'bail|required|min:2',
            'email' => 'required|email|unique:users,email,' . $id,
            'roles' => 'required|min:1',
        ]);

        // Get the user
        $user = User::find($id);              
        // Update user
        $user->fill($request->except('roles', 'ic_number', 'epf_id', 'socso_id', 'position_id', 'status', 'staff_number', 'password', 'password_confirmation','gender','join_date'));

        // check for password change
        if ($request->get('password')) {
            $user->password = Hash::make($request->get('password'));
        }

        $user->save();        
        // Handle the user roles
        $this->syncPermissions($request, $user);

        toast('Employee information updated successfully', 'success', 'top-right');
        return back();
    }

    public function destroy($id)
    {
        $this->user->find($id)->delete();
        toast('Employee deleted successfully', 'success', 'top');
        return back();
    }

    public function loadPrimarySchools()
    {

        $json = File::get(database_path('primary-school.json'));
        return $primarySchoolData = json_decode($json);

    }

    public function sendEmail()
    {
        Mail::send('emails.send', ['title' => $title, 'content' => $content], function ($message) {

            $message->from('me@gmail.com', 'Christian Nwamba');

            $message->to('chrisn@scotch.io');

        });
    }

    public function testApi()
    {

        $banks = $this->makeRequest('GET', 'banks');

        return $banks;
    }

}
