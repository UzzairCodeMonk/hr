<div class="card bg-lighter">
    <div class="card-header">
        <h3 class="card-title">{{isset($academy) ? 'Update':'Create'}} Academic Record</h3>
        <div class="card-options">
            @isset($academy)
            <a href="{{URL::previous()}}" class="btn btn-secondary btn-sm">Cancel</a>
            @endisset
            <button type="submit" class="btn btn-primary btn-sm">{{isset($academy) ? 'Update':'Create'}}</button>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="">Study Level</label>
                    <input type="text" name="study_level" class="form-control" value="{{old('study_level',$academy->study_level ?? '')}}" />
                    @include('backend.shared._errors',['entity'=>'study_level'])
                </div>
            </div>
            <div class="col">

                <div class="form-group">
                    <label for="">Institution</label>
                    <input type="text" name="institution" class="form-control" value="{{old('institution',$academy->institution ?? '')}}" />
                    @include('backend.shared._errors',['entity'=>'institution'])
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <label for="" class="require">Starting Date</label>
                    <input type="text" name="start_date" class="form-control start-date" value="{{old('start_date',$academy->start_date ?? '')}}" />
                    @include('backend.shared._errors',['entity'=>'start_date'])
                </div>
            </div>
        </div>
        <!-- new row -->
        <div class="row">
            <div class="col">
                <label for="" class="require">Graduation Date</label>
                <input type="text" name="end_date" class="form-control end-date" value="{{old('end_date',$academy->end_date ?? '')}}" />
                @include('backend.shared._errors',['entity'=>'end_date'])
            </div>
            <div class="col">
                <label for="" class="require">Course</label>
                <input type="text" name="course" class="form-control" value="{{old('course',$academy->course ?? '')}}" />
                @include('backend.shared._errors',['entity'=>'course'])
            </div>
            <div class="col">
                <label for="" class="require">Result</label>
                <input type="text" name="result" class="form-control" value="{{old('result',$academy->result ?? '')}}" />
                @include('backend.shared._errors',['entity'=>'result'])
            </div>
        </div>
    </div>
</div>
