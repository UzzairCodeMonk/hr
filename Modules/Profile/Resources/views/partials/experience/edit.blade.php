<form action="{{route('experience.update',['id'=>$expPersonal->id])}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col">
            <table class="table table-bordered mt-3">
                <thead class="thead-light">
                    @include('profile::partials.experience.table-header')
                </thead>
                <tbody>
                    <tr>
                        <td>
                            1
                        </td>
                        <td>
                            <input type="text" name="company" class="form-control" value="{{$expPersonal->company ?? ''}}" />
                        </td>
                        <td>
                            <input type="text" name="position" class="form-control" value="{{$expPersonal->position ?? ''}}" />
                        </td>
                        <td>
                            <input type="text" name="start_date" class="form-control start-date" value="{{$expPersonal->start_date ?? ''}}" />
                        </td>
                        <td>
                            <input type="text" name="end_date" class="form-control end-date" value="{{$expPersonal->end_date ?? ''}}" />
                        </td>
                        <td>
                            <textarea name="description" class="form-control" id="" cols="30" rows="10">{!! $expPersonal->description ?? '' !!}</textarea>
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
