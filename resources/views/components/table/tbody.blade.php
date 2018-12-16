@foreach($columnNames as $columnName)
<td>{{$result->$columnName}}</td>
@endforeach
