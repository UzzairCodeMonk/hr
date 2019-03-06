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
use Modules\Wage\Entities\Wage;

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
            'centers'=>DB::table('centers')->get()
        ]);
    }

    public function edit($id)
    {
        return view('backend.users.form', [
            'user' => $this->user->find($id),
            'positions' => $this->position->all(),
            'roles' => $this->role->pluck('name', 'id'),
            'banks' => DB::table('banks')->get(),
            'centers'=>DB::table('centers')->get()
        ]);
    }

    public function store(CreateEmployeeRequest $request)
    {        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $this->syncPermissions($request, $user);
        toast('Employee created successfully', 'success', 'top-right');
        return back();
    }

    public function update(Request $request, $id)
    {        
        // Get the user
        $user = User::find($id);                     
        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);
        
        // check for password change
        if ($request->get('password')) {
            $user->password = Hash::make($request->get('password'));
            $user->save();
        }

        $p = $this->personalDetail->where('user_id', $user->id)->first();

        $p->name = $request->name;
        $p->ic_number = $request->ic_number;
        $p->staff_number = $request->staff_number;
        $p->socso_id = $request->socso_id;
        $p->epf_id = $request->epf_id;
        $p->position_id = $request->position_id;
        $p->status = $request->status;
        $p->gender = $request->gender;
        $p->join_date = $request->join_date;
        $p->resignation_date = $request->resignation_date;        
        $p->bank_id = $request->bank_id;
        $p->bank_account_number = $request->bank_account_number;
        $p->center_id = $request->center_id;
        $p->save();

        // update basic salary
        Wage::updateOrCreate(['user_id'=>$id],['wage'=>$request->basic_salary]);
                
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
