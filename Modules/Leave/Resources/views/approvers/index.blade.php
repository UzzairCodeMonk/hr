@extends('backend.master')
@section('page-title')
Set Employees Leave Approvals
@endsection
@section('page-css')
<style>
    .preloader {
        display: none !important;
    }

</style>
<link rel="stylesheet" href="{{asset('css/select2-bootstrap.min.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" />
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3>@yield('page-title')</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <table class="table table-bordered table-striped datatable" id="">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th class="text-center">Approvers</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($results))
                        @foreach($results as $key=>$result)

                        <tr>
                            <td>{{++$key}}</td>
                            <td>
                                <div class="media">
                                    <img class="avatar" src="{{asset($result->personalDetail['avatar']) ?? '' }}"
                                        alt="">
                                    <div class="media-body">
                                        <p class="lh-1">{{$result->name ?? 'N/A'}}</p>
                                        <small>{!! $result->personalDetail->position->name ?? 'N/A' !!}
                                            {{$code ?? 'N/A'}} {{$result->personalDetail->staff_number ?? 'N/A'}}
                                        </small>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                {{$result->email ?? 'N/A'}}
                            </td>
                            <td class="text-center">
                                <!-- <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#approver_modal" data-id="{{$result->id}}">Set Approver</button> -->
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#approvers" data-id="{{$result->id}}">Set Approver</button>  
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="{{count($columnNames)+2}}" class="text-center">No records found.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>

            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="approvers" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Leave Approvers</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <!-- <form> -->
                <button class="btn btn-primary btn-sm pull-right" id="add" type="button">Add Group</button>
                <div id="dynamic_field">
                    <div id="row1" class="dynamic-added">
                        <label class="col-form-label">Group 1</label><br>
                        <select id="leaves" multiple class="form-control leaves" name="leaves[]" style="width:400px;"></select>
                        <div class="input-group-btn form-group">
                            <button class="btn btn-sm btn-danger btn2" id="1" type="button">Delete</button>
                        </div>
                    </div>
                </div>
               <!-- </form> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="approver_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Recipient:</label>
                        <input type="text" class="form-control" id="recipient-name">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Message:</label>
                        <textarea class="form-control" id="message-text"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Message:</label>
                        <ul id="approvers"></ul>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Send message</button>
            </div>
        </div>
    </div>
</div>
@endsection


@section('page-js')
@include('asset-partials.datatable')
<script src="https://cdnjs.cloudflare.com/ajax/libs/pluralize/7.0.0/pluralize.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.datatable').DataTable();
    });

</script>
<script type="text/javascript">
    $('.select').select2({
        theme:'classic'
    });
</script>

<script type="text/javascript">
    function createNode(element) {
        return document.createElement(element);
    }

    function append(parent, el) {
        return parent.appendChild(el);
    }

    $('#approver_modal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var recipient = button.data('id');     
        
        fetch('http://datakraf-hr.web/api/user/' + recipient)
            .then(response => response.json())
            .then(function (data) {
                console.log(data.user);
                $('.modal-title').text('New message to ' + data.user[0].name);
                $('#message-text').val(data.user[0].name);                                
                let approvers = data.user[0].leave_approvers;
                const ul = document.getElementById('approvers');  
                if (approvers.length > 0) {
                    approvers.map(function (approver) {
                        let li = createNode('li'),
                            span = createNode('span');
                        span.innerHTML.empty();
                        span.innerHTML = approver.name;
                        append(li, span);
                        append(ul, li);
                    });
                } else { 
                    span.innerHTML.empty();                          
                    span.innerHTML = 'No approvers';
                    append(li, span);
                    append(ul, li);
                }
            });
    })
    // $(document).ready(function(){
    $('.leaves').select2({
        dropdownParent: $('#approvers'),
        placeholder: 'Please type the approver\'s name. You may tag multiple approvers',
        multiple: true,
        ajax: {
            url: "{{route('api.users.index')}}",
            dataType: 'json',
            data: function (params) {
                return {
                    q: $.trim(params.term)
                };
            },
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
    // });

    var leaveApproversSelect = $('.leaves');
    @isset($user)
    $.ajax({
        type: 'GET',
        url: "{{route('user.leave-approvers',['id'=>$user->id])}}",
    }).then(function (data) {
        console.log(data);
        // create the option and append to Select2
        data.map(function (approver) {
            var option = new Option(approver.name, approver.id, true, true);

            leaveApproversSelect.append(option).trigger('change');

            leaveApproversSelect.trigger({
                type: 'select2:select',
                params: {
                    data: approver
                }
            });
        });
    });
    @endisset

    //leave approver
    $(document).ready(function(){
        var i= 1;
        $('#add').click(function(){
            // for(i;i<=6;i++){
                i++;
                if(i<=6){
            $('#dynamic_field').append('<div id="row'+i+'" class="dynamic-added"><label for="">Group'+' '+i+'</label><br><select id="leaves" multiple class="form-control leaves" name="leaves[]" style="width:400px;"></select><div class="input-group-btn form-group"><button class="btn btn-sm btn-danger btn2" id="'+i+'" type="button">Delete</button></div></div>');
            }
            $('.leaves').select2({
                dropdownParent: $('#approvers'),
                placeholder: 'Please type the approver\'s name. You may tag multiple approvers',
                multiple: true,
                ajax: {
                    url: "{{route('api.users.index')}}",
                    dataType: 'json',
                    data: function (params) {
                        return {
                            q: $.trim(params.term)
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            });
            
        });
    
        $(document).on('click', '.btn2', function(){
            var button_id = $(this).attr("id");
            $('#row'+button_id+'').remove();
        });
    });

</script>
@include('components.form.confirmDeleteOnSubmission',['entity'=>'employee','action'=>'delete'])
@endsection
