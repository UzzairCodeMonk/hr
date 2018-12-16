<table class="table table-bordered table-striped" id="">
    <thead>
        <tr>
            <th>#</th>
            @foreach($columnNames as $columnName)
            <th>
                {{ucwords($columnName)}}
            </th>
            @endforeach
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($results as $key=>$result)
        <tr>
            <td>{{++$key}}</td>
            @foreach($columnNames as $columnName)
            <td>
                {{$result->$columnName}}
            </td>
            @endforeach
            <td>
                @if(isset($actions))
                @foreach($actions as $action)
                <a href="{{route($action['url'],['id'=>$result->id])}}" class="{{$action['class']}}" id="{{$action['id']}}">
                    {{$action['text']}}
                </a>
                @isset($action['delete'])
                    <form action="{{route($action['delete']['url'],['id'=>$result->id])}}" method="POST" onsubmit="return confirmFormSubmit();">
                        @csrf
                        {{method_field('DELETE')}}
                        <button class="{{$action['delete']['class']}}">{{$action['delete']['text']}}</button>
                    </form>
                @endisset
                @endforeach
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
