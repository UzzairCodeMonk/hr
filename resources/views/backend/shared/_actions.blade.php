@can('edit_'.$entity)
<a href="{{ route($entity.'.edit', ['id' => $application->id])  }}" class="btn btn-secondary btn-sm"><i class="fe fe-edit"></i> Edit</a>
@endcan

@can('delete_'.$entity)
    {!! Form::open( ['method' => 'delete', 'url' => route($entity.'.destroy', [str_singular($entity) => $id]), 'style' => 'display: inline', 'onSubmit' => 'return confirm("Are yous sure wanted to delete it?")']) !!}
<button type="submit" class="btn-delete btn btn-sm btn-danger" >
            <i class="fe fe-trash"></i> Delete
        </button>
    {!! Form::close() !!}
@endcan                 