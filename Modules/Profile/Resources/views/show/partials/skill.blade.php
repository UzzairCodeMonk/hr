<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Skill</th>
            <th>Proficiency (Rate in %)</th>
        </tr>
    </thead>
    <tbody>
        @if(count($skills))
        @foreach($skills as $key=> $record)
        <tr>
            <td>
                {{++$key}}
            </td>
            <td>
                <p>{{$record->skill ?? 'N/A'}}</p>
            </td>
            <td>
                <p>{{$record->period ?? 'N/A'}}</p>
            </td>
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="7">
                <p class="text-center">No skill records can be found.</p>
            </td>
        </tr>
        @endif

    </tbody>
</table>
