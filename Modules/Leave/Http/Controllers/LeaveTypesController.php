<?php

namespace Modules\Leave\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Leave\Entities\LeaveType;
use Datakraf\Traits\AlertMessage;

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
  
    public function store(Request $request)
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

    public function update(Request $request, $id)
    {
        $this->type->find($id)->update($this->data);
        toast($this->message('update', 'Leave type #' . $id), 'success', 'top-right');
        return redirect()->route('leave-type.index');
    }


    public function destroy($id)
    {
        $this->type->find($id)->delete();
        toast($this->message('delete', 'Leave type #' . $id), 'success', 'top-right');
        return redirect()->route('leave-type.index');
    }

}
