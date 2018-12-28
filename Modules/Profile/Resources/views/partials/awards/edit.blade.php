<form action="{{route('award.update',['id'=>$award->id])}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col">
            <table class="table table-bordered mt-3">
                <thead class="thead-light">
                    @include('profile::partials.awards.table-header')
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>
                            <input type="text" name="name" class="form-control" value="{{$award->name ?? ''}}"/>
                        </td>
                        <td>
                            <input type="text" name="received_date" class="form-control received-date" value="{{$award->received_date ?? ''}}"/>
                        </td>
                        <td>
                            <input type="text" name="notes" class="form-control" value="{{$award->notes ?? ''}}"/>
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
