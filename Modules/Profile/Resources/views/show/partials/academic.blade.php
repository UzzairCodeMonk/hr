<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Institution</th>
            <th>Level of Study</th>
            <th>Start Date</th>
            <th>Graduation Date</th>
            <th>Course</th>
            <th>Result</th>
        </tr>
    </thead>
    <tbody>
        @if(count($academics))
        @foreach($academics as $key=> $record)
        <tr>
            <td>
                {{++$key}}
            </td>
            <td>
                <p>{{$record->institution ?? 'N/A'}}</p>
            </td>
            <td>
                <p>{{$record->study_level ?? 'N/A'}}</p>
            </td>
            <td>
                <p>{{Carbon\Carbon::parse($record->start_date)->format('d/m/Y') ?? 'N/A'}}</p>
            </td>
            <td>
                <p>{{Carbon\Carbon::parse($record->end_date)->format('d/m/Y') ?? 'N/A'}}</p>
            </td>
            <td>
                <p>{{$record->course ?? 'N/A'}}</p>
            </td>
            <td>
                <p>{{$record->result ?? 'N/A'}}</p>
            </td>
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="7">
                <p class="text-center">No academic records can be found.</p>
            </td>
        </tr>
        @endif
    </tbody>
</table>
