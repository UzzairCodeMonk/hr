<form action="{{route('academic.update',['id'=>$academy->id])}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col">
            <table class="table table-bordered mt-3">
                <thead class="thead-light">
                    @include('profile::partials.academic.table-header')
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>
                            <input type="hidden" name="user_id" value="{{$academy->user_id}}">
                            <input type="text" name="institution" class="form-control" value="{{$academy->institution}}"/>
                        </td>
                        <td>
                            <input type="text" name="study_level" class="form-control"  value="{{$academy->study_level}}"/>
                        </td>
                        <td>
                            <input type="text" name="start_date" class="form-control start-date"  value="{{$academy->start_date}}"/>
                        </td>
                        <td>
                            <input type="text" name="end_date" class="form-control end-date"  value="{{$academy->end_date}}"/>
                        </td>
                        <td>
                            <input type="text" name="result" class="form-control"  value="{{$academy->result}}"/>
                        </td>
                        <td>
                            <input type="text" name="course" class="form-control"  value="{{$academy->course}}"/>
                        </td>
                        <td class="text-center">
                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                            <a href="{{URL::previous()}}" class="btn btn-secondary btn-sm">Cancel</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</form>
