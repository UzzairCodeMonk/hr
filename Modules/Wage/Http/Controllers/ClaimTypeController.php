<?php

namespace Modules\Wage\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Wage\Entities\ClaimType;
use Datakraf\Traits\AlertMessage;
use Modules\Wage\Entities\Claim;
use Modules\Wage\Entities\ClaimDetail;

class ClaimTypeController extends Controller
{
    use AlertMessage;

    public function __construct(ClaimType $type, Request $request)
    {
        $this->type = $type;
        $this->data = ['name' => $request->name];
        $this->columnNames = ['name'];
        $this->actions = [
            'edit' => [
                'url' => 'claim-type.edit',
                'text' => ucwords('edit'),
                'class' => 'text-dark',
                'id' => ''
            ]
        ];
        $this->deleteAction = [
            'delete' => [
                'url' => 'claim-type.destroy',
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
        return view('wage::claims.admin.category', ['columnNames' => $this->columnNames, 'results' => $results, 'actions' => $this->actions, 'deleteAction' => $this->deleteAction]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('wage::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $this->type->create($this->data);
        toast($this->message('save', 'Claim type ' . $request->name), 'success', 'top-right');
        return redirect()->route('claim-type.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('wage::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('wage::claims.admin.category', [
            'entity' => $this->type->find($id),
            'columnNames' => $this->columnNames,
            'actions' => $this->actions,
            'results' => $this->type->all(),
            'deleteAction' => $this->deleteAction
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->type->find($id)->update($this->data);
        toast($this->message('update', 'Claim type #' . $id), 'success', 'top-right');
        return redirect()->route('claim-type.index');

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
        $type= $this->type->find($id);
        //check claim type kt claim yg assign in tyleclaim yg nak delete
        $claimexists = ClaimDetail::where('claimtype_id',$id)->exists();

        if($claimexists == true){
            toast('Claim type deleted unsuccessfully. Please remove this following claims from this claim type before deleting', 'error', 'top-right');
        }
        else{
            $type->delete();
            toast($this->message('delete', 'Claim type #' . $id), 'success', 'top-right');
        }
        return redirect()->route('claim-type.index');
    }
}
