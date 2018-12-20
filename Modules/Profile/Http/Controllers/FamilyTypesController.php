<?php

namespace Modules\Profile\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Profile\Entities\FamilyType;
use Datakraf\Traits\AlertMessage;

class FamilyTypesController extends Controller
{
    use AlertMessage;

    protected $type;

    public function __construct(FamilyType $type, Request $request)
    {
        $this->type = $type;
        $this->data = ['name' => $request->name, 'description' => $request->description];
        $this->columnNames = ['name', 'description'];
        $this->actions = [
            'edit' => [
                'url' => 'family-type.edit',
                'text' => ucwords('edit'),
                'class' => 'btn btn-link text-dark',
                'id' => ''
            ]
        ];
        $this->deleteAction = [
            'delete' => [
                'url' => 'family-type.destroy',
                'text' => ucwords('delete'),
                'class' => 'btn btn-link btn-danger text-white',
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
        return view('profile::forms.personal-details.family-types', ['columnNames' => $this->columnNames, 'results' => $results, 'actions' => $this->actions, 'deleteAction' => $this->deleteAction]);
    }

    public function store(Request $request)
    {
        $this->type->create($this->data);
        toast($this->message('save','Family type '.$request->name), 'success', 'top-right');
        return redirect()->route('family-type.index');
    }

    public function edit($id)
    {
        return view('profile::forms.personal-details.family-types', [
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
        toast($this->message('update','Family type #'.$id), 'success', 'top-right');
        return redirect()->route('family-type.index');
    }


    public function destroy($id)
    {
        $this->type->find($id)->delete();
        toast($this->message('delete','Family type #'.$id), 'success', 'top-right');
        return redirect()->route('family-type.index');
    }
}
