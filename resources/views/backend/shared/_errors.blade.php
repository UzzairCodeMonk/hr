@if ($errors->has($entity))
<p class="text-danger">{{ $errors->first($entity) }}</p>
@endif