<select class="{{$class ?? ''}}" name="{{$fieldName ?? ''}}" >
    @for($i = 1; $i <= config('star-rating-ui.star-count',5);$i++)
     <option value="{{$i}}" {{ isset($skill) && $i == $skill->period ? 'selected':null}}>{{$i}}</option>
    @endfor
</select>
