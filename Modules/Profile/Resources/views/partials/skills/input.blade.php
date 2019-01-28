<div class="card bg-lighter">
    <div class="card-header">
        <h4 class="card-title text-dark">{{isset($family) ? 'Update':'Create'}} Skill Record</h4>
        <div class="card-options">
            @isset($skill)
            <a href="{{URL::previous()}}" class="btn btn-secondary btn-sm">Cancel</a>
            @endisset
            <button type="submit" class="btn btn-primary btn-sm">{{isset($skill) ? 'Update':'Create'}}</button>
            <!-- <a class="btn btn-sm btn-secondary text-dark" id="addrow"> Add Row </a> -->
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <label for="" class="require">Name</label>
                <input type="text" name="skill" class="form-control" 
                value="{{old('skill',$skill->skill ?? null)}}" />
                @include('backend.shared._errors',['entity'=>'skill'])
            </div>
            <div class="col">
                <label for="" class="require">Proficiency Rate</label>
                <!-- <input type="text" name="period" class="form-control" value="{{old('period',$skill->period ?? null)}}" /> -->
                @include('vendor.star-rating-ui.star-rating',['fieldName' => 'period','class'=>'period'])
                @include('backend.shared._errors',['entity'=>'period'])
            </div>
        </div>
    </div>
</div>

