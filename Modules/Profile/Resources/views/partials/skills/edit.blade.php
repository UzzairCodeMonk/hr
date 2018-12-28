<form action="{{route('skill.update',['id'=>$skill->id])}}" method="POST" enctype="multipart/form-data">
        @csrf    
    <div class="row">
        <div class="col">
            <table class="table table-bordered mt-3">
                <thead class="thead-light">
                    @include('profile::partials.skills.table-header')
                </thead>
                <tbody>
                    <tr>
                            <td>1</td>
                            <td>
                                <input type="text" name="skill" class="form-control" value="{{$skill->skill}}"/>
                            </td>
                            <td>
                                <input type="text" name="period" class="form-control" value="{{$skill->period}}"/>
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