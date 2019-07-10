<?php

namespace Modules\Leave\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Leave\Entities\LeaveType;
use Datakraf\Traits\AlertMessage;
use Modules\Leave\Http\Requests\CreateLeaveCategoryRequest;
use Modules\Leave\Entities\LeaveBalance;
use Modules\Leave\Entities\Leave;

class LeaveTypesController extends Controller
{
    use AlertMessage;

    public function __construct(LeaveType $type, Request $request)
    {
        $this->type = $type;
        $this->data = ['name' => $request->name, 'days' => $request->days];
        $this->columnNames = ['name', 'days'];
        $this->actions = [
            'edit' => [
                'url' => 'leave-type.edit',
                'text' => ucwords('edit'),
                'class' => 'text-dark',
                'id' => ''
            ]
        ];
        $this->deleteAction = [
            'delete' => [
                'url' => 'leave-type.destroy',
                'text' => ucwords('delete'),
                'class' => 'text-danger',
                'id' => ''
            ]
        ];

    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $results = $this->type->all();
        return view('leave::type.index', ['columnNames' => $this->columnNames, 'results' => $results, 'actions' => $this->actions, 'deleteAction' => $this->deleteAction]);
    }

    public function store(CreateLeaveCategoryRequest $request)
    {
        $this->type->create($this->data);
        toast($this->message('save', 'Leave type ' . $request->name), 'success', 'top-right');
        return redirect()->route('leave-type.index');
    }

    public function edit($id)
    {
        return view('leave::type.index', [
            'entity' => $this->type->find($id),
            'columnNames' => $this->columnNames,
            'actions' => $this->actions,
            'results' => $this->type->all(),
            'deleteAction' => $this->deleteAction
        ]);
    }

    public function update(CreateLeaveCategoryRequest $request, $id)
    {
        $this->type->find($id)->update($this->data);
        toast($this->message('update', 'Leave type #' . $id), 'success', 'top-right');
        return redirect()->route('leave-type.index');
    }


    public function destroy($id)
    {
        $type= $this->type->find($id);
        //check leave type kt leave yg assign in typeleave yg nak delete
        $leaveexists = Leave::where('leavetype_id',$id)->exists();
        $balanceexists = LeaveBalance::where('leavetype_id',$id)->exists();

        if($leaveexists == true || $balanceexists == true){
            toast('Leave type deleted unsuccessfully. Please remove this following leaves from this leave type before deleting', 'error', 'top-right');
        }
        else{
            $type->delete();
            toast($this->message('delete', 'Leave type #' . $id), 'success', 'top-right');
        }
        // $this->type->find($id)->delete();
        // toast($this->message('delete', 'Leave type #' . $id), 'success', 'top-right');
        return redirect()->route('leave-type.index');
    }

}
