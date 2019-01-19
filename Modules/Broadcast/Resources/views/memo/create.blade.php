@extends('backend.master')
@section('page-title')
Publish A New Memo
@endsection
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
                <label for="">Recepient</label>
                <select name="recepient_id" id="" class="select form-control" multiple>
                    <option value="hello">hello</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Message</label>
                <textarea name="message" id="message" cols="30" rows="10" class="form-control"></textarea>
            </div>
        </div>

    </div>
</div>

@endsection
@section('page-js')
@include('asset-partials.select2')
@include('asset-partials.summernote')
<script type="text/javascript">
    $('#message').summernote();
    $('.select').select2();
</script>
@endsection
