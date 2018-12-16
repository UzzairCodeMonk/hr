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
            <td></td>
        </tr>
        @endforeach
    </tbody>
</table>
