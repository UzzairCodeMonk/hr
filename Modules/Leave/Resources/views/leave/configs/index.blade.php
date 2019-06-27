@extends('backend.master')
@section('page-title')
Leave Config
@endsection
@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            Leave Configurations
        </h3>
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col-4">
                <h3>Holidays</h3>
                <p class="help-text">
                    Holidays (non-working days) for each cost center.
                </p>
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add-center-modal">
                    Add Center
                </button>
            </div>
            <div class="col-8">
                <div class="form-group">
                    <label for="">Please mark the holidays for each working center</label>
                    <br>
                    @if($centers->count())
                    @foreach($centers as $center)
                    <form action="{{route('leave.config.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" value="{{$center->id}}" name="center_id">
                            <h5>{{$center->code ?? 'N/A'}} => {{$center->name ?? 'N/A'}}</h5>
                            @foreach($days as $day)

                            {{ Form::checkbox(
                            'days[]',
                            $day->id,
                            (in_array($day->id, $center->holidays->pluck('id')->toArray())),
                            ['class' => 'checkbox checkbox-inline']
                            )
                            }}
                            <label for="">{{$day->name ?? 'N/A'}}</label>
                            @endforeach

                        </div>
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                        
                    </form>
                    <form action="{{route('leave.config.destroy',['id'=>$center->id])}}" method="POST" class="deleteconfirm{{$center->id}} d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="deletecenter({{$center->id}})" >Delete</button>
                        </div>
                    </form>  
                    @endforeach
                    @endif
                </div>


            </div>
        </div>

    </div>
</div>
<!-- add center -->
<div class="modal fade" id="add-center-modal" tabindex="-1" role="dialog" aria-labelledby="add-center-modal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Cost Center</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- <form action="" id="addcenter"> -->
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="name" id="name" class="form-control name">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Code Center</label>
                                <input type="text" name="code" id="code" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Address Line 1</label>
                                <input type="text" name="address_one" id="address_one" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Address Line 2</label>
                                <input type="text" name="address_two" id="address_two" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Postcode</label>
                                <input type="text" name="postcode" id="postcode" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">City</label>
                                <input type="text" name="city" id="city" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">State</label>
                                <input type="text" name="state" id="state" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Country</label>
                                <input type="text" name="country" id="country" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Mobile Number</label>
                                <input type="text" name="mobile_number" id="mobile_number" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Phone Number</label>
                                <input type="text" name="phone_number" id="phone_number" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Fax Number</label>
                                <input type="text" name="fax_number" id="fax_number" class="form-control">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" name="email" id="email" class="form-control">
                                <div id="alertemail" style="display:none">
                                    <div id="alert-message-email"></div>
                                </div>  
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <button type="button" id="centeradd" class="btn btn-primary">Add</button>
                            </div>
                        </div>
                    </div>
                <!-- </form> -->
            </div>
        </div>
    </div>
</div>
<!-- end add center -->

@endsection

@section('page-js')
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),
        'Authorization': 'Bearer ' + $('meta[name="api-token"]').attr('content'),
        'Accept': 'application/json'
    }
    });
    $(document).ready(function(){
        $("#centeradd").on("click", function(){
        var emailReg = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        var email = $("#email").val();
        console.log(emailReg);
        if(!emailReg.test(email)){
            $("#alert-message-email").html("<span style='color: red'>It should be in email format</span>");
            $("#alertemail").show();
        }
        else if(emailReg.test(email)){
            var formData = new FormData();
            formData.append('name', $(".name").val());
            formData.append('code', $("#code").val());
            formData.append('address_one', $("#address_one").val());
            formData.append('address_two', $("#address_two").val());
            formData.append('postcode', $("#postcode").val());
            formData.append('city', $("#city").val());
            formData.append('state', $("#state").val());
            formData.append('country', $("#country").val());
            formData.append('mobile_number', $("#mobile_number").val());
            formData.append('phone_number', $("#phone_number").val());
            formData.append('fax_number', $("#fax_number").val());
            formData.append('email', $("#email").val());
            console.log(formData);
        
        
            $.ajax({
            url: '{{route('leave.config.add')}}',
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response){
                const toast = swal.mixin({
                    toast: true,
                    position: 'top-right',
                    showConfirmButton: false,
                    timer: 6000
                });
                toast({
                    type: 'success',
                    title: 'Center added successfully'
                })
                window.location.href = '{{route('leave.config.index')}}';
            },
            error: function(){
                }

            });
            }
            
        });
        $.ajax({
                url: '{{route('leave.config.getcode')}}',
                type: "GET",
                dataType: 'text json',
                success: function(result){
                    console.log(result);
                    $('#code').val(result);
                },
                error: function(result){
                }
            });
    

    });

   function deletecenter(id){
         event.preventDefault();
        return swal({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-danger',
            buttonsStyling: false,
            confirmButtonText: '<i class="ti ti-check"></i> Yes, I\'m sure',
            confirmButtonAriaLabel: 'Thumbs up, great!',
            cancelButtonText: '<i class="ti ti-close"></i> Nope, abort mission',
            cancelButtonAriaLabel: 'Thumbs down',
            reverseButtons:true
        }).then((result) => {
            if (result.value) {
                $(".deleteconfirm"+id).trigger('submit');
            }
        });
    }
</script>
@endsection
