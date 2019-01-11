<?php

namespace Modules\Leave\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Leave\Entities\Holiday;
use Datakraf\Traits\AlertMessage;

class HolidaysController extends Controller
{
    use AlertMessage;

    public function __construct(Holiday $holiday, Request $request)
    {
        $this->holiday = $holiday;
        $this->data = ['name' => $request->name, 'date' => $request->date];
        $this->columnNames = ['name', 'date'];
        $this->actions = [
            'edit' => [
                'url' => 'holiday.edit',
                'text' => ucwords('edit'),
                'class' => 'text-dark',
                'id' => ''
            ]
        ];
        $this->deleteAction = [
            'delete' => [
                'url' => 'holiday.destroy',
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
        $results = $this->holiday->all();
        return view('leave::holiday.index', ['columnNames' => $this->columnNames, 'results' => $results, 'actions' => $this->actions, 'deleteAction' => $this->deleteAction]);
    }
  
    public function store(Request $request)
    {
        $this->holiday->create($this->data);
        toast($this->message('save', 'Public holiday ' . $request->name), 'success', 'top-right');
        return redirect()->route('holiday.index');
    }

    public function edit($id)
    {
        return view('leave::holiday.index', [
            'entity' => $this->holiday->find($id),
            'columnNames' => $this->columnNames,
            'actions' => $this->actions,
            'results' => $this->holiday->all(),
            'deleteAction' => $this->deleteAction
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->holiday->find($id)->update($this->data);
        toast($this->message('update', 'Public holiday #' . $id), 'success', 'top-right');
        return redirect()->route('holiday.index');
    }


    public function destroy($id)
    {
        $this->holiday->find($id)->delete();
        toast($this->message('delete', 'Leave holiday #' . $id), 'success', 'top-right');
        return redirect()->route('holiday.index');
    }

}
