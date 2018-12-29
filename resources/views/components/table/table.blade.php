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
                {{$result->$columnName}}
            </td>
            @endforeach
            <td class="text-center">
                @if(isset($actions))
                @foreach($actions as $action)
                <div class="">
                    <a class="nav-link hover-primary d-inline-block" href="{{route($action['url'],['id'=>$result->id])}}" data-provide="tooltip"
                        title="" data-original-title="Edit" id="{{$action['id']}}" style="border-right:1px solid black">Edit</a>
                    <a class="nav-link hover-primary d-inline-block" href="{{route($action['url'],['id'=>$result->id])}}" data-provide="tooltip"
                        title="" data-original-title="Edit" id="{{$action['id']}}">Delete</a>
                </div>
                <!-- <a  class="btn btn-sm {{$action['class']}}" >
                    {{$action['text']}}
                </a> -->
                <!-- @isset($deleteAction)
                <form class="{{$entity}}" action="{{route($deleteAction['delete']['url'],['id'=>$result->id])}}"
                    method="POST" style="display:inline !important;">
                    @csrf
                    {{method_field('DELETE')}}
                    <button type="submit" class="btn btn-sm {{$deleteAction['delete']['class']}}">{{$deleteAction['delete']['text']}}</button>
                </form>
                @endisset -->
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
