@extends('backend.master')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            Publish New Memo
        </h3>
    </div>
    <div class="card-body">
        <div class="col">
            <div class="form-group">
                <label for=""></label>
                <select name="recepient_id" id="" class="selectize" multiple></select>
            </div>
        </div>
    </div>
</div>

@endsection
