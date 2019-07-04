@extends('backend.master')
@section('page-title')
Cost Centers
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Cost Centers</h3>
    </div>
    <form action="{{route('company.delete')}}" method="POST" class="company-bulk-delete">
        @csrf
        @method('DELETE')
        <div class="card-body">
            <div class="pull-right">
                <a href="{{route('company.create')}}" class="btn btn-sm btn-primary mr-2">Create</a>
                <button type="submit" name="delete" class="btn btn-sm btn-danger pull-right">Delete <span class="counter-text"></span>
                    selected records</button>               
            </div>

            <div class="mt-5"></div>
            <table class="table-striped table-bordered table datatable">
                <thead>
                    <tr>
                        <th><input type="checkbox" class="check-all"></th>
                        <th>#</th>
                        <th>Cost Center</th>                        
                        <th class="text-center">Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($centers as $key=>$n)
                    <tr>
                        <td><input type="checkbox" class="checkbox" name="ids[]" value="{{$n->id}}"></td>
                        <td>
                            {{++$key}}
                        </td>
                        <td>
                           {!! $n->name ?? 'N/A'!!}
                        </td>                        
                        <td class="text-center">
                            <div class="badge badge-{{$n->status == 1 ? 'primary':'danger'}}">
                                {{$n->status == 1 ? 'Active':'Inactive'}}</div>
                        </td>
                        <td class="text-center">
                                <a class="btn btn-sm btn-secondary" href="{{route('company.edit',['id'=>$n->id])}}">Edit</a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </form>
</div>


@endsection
@section('page-js')
@include('asset-partials.datatable')

@include('asset-partials.checkbox-select',
['allCheckboxSelector'=>'.check-all',
'checkboxSelector'=>'.checkbox',
'inputNameOfCheckbox'=>'ids',
'selectedCheckboxCounterText'=>'.counter-text'])

<script type="text/javascript">
    $(document).ready(function () {
        $('.datatable').DataTable();
    });

</script>
<!-- @include('components.form.confirmDeleteOnSubmission',['entity'=>'company-bulk-delete']) -->
@endsection
