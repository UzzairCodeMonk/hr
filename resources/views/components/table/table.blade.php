<table class="table table-bordered table-striped {{isset($datatable) ? 'datatable':''}}" id="">
    <thead>
        <tr>
            <th>#</th>
            @foreach($columnNames as $columnName)
            <th>
                {{ucwords($columnName)}}
            </th>
            @endforeach
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @if(count($results))
        @foreach($results as $key=>$result)
        <tr>
            <td>{{++$key}}</td>
            @foreach($columnNames as $columnName)
            <td>
                {{$result->$columnName ?? 'N/A'}}
            </td>
            @endforeach
            <td class="text-center">
                @if(isset($actions))
                @foreach($actions as $action)
                
                <a  href="{{route($action['url'],['id'=>$result->id])}}" class="btn btn-sm {{$action['class']}}" >
                    {{$action['text']}}
                </a>
                @isset($deleteAction)
                <form class="{{$entity}}" action="{{route($deleteAction['delete']['url'],['id'=>$result->id])}}"
                    method="POST" style="display:inline !important;">
                    @csrf
                    {{method_field('DELETE')}}
                    <button type="submit" class="btn btn-sm {{$deleteAction['delete']['class']}}">{{$deleteAction['delete']['text']}}</button>
                </form>
                @endisset
                @endforeach
                @endif
            </td>
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="{{count($columnNames)+2}}" class="text-center">No records found.</td>
        </tr>
        @endif
    </tbody>
</table>
