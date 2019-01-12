<script type="text/javascript">
    $(document).ready(function () {
        var counter = 2;
        $("#addrow").on("click", function () {
            var newRow = $("<div>");
            var cols = "";            
            cols += '<div class="card bg-lighter">'
            cols += '<div class="card-header">'
            cols += '<h4 class="card-title text-dark">Add Family Record #'+counter+'</h4>'
            cols += '<div class="card-options">'            
            cols += '<a class="ibtnDel btn btn-sm btn-danger text-white">Remove</a>'
            cols += '</div>'
            cols += '</div>'
            cols += '<div class="card-body">'
            cols += '<div class="row">'
            cols += '<div class="col">'
            cols += '<div class="form-group">'
            cols += '<input type="hidden" name="user_id[]" value="{{Auth::id()}}">'
            cols += '<label for="">Name</label>'
            cols += '<input type="text" name="name[]" class="form-control" />'
            cols += '</div>'
            cols += '</div>'
            cols += '<div class="col">'
            cols += '<div class="form-group">'
            cols += '<label for="">Relationship</label>'
            cols += '<select name="relationship_id[]" id="" class="form-control">'
            cols += '@foreach($types as $type)'
            cols += '<option value="{{$type->id}}">{{$type->name}}</option>'
            cols += '@endforeach'
            cols += '</select>'
            cols += '</div>'
            cols += '</div>'
            cols += '<div class="col">'
            cols += '<div class="form-group">'
            cols += '<label for="">IC No.</label>'
            cols += '<input type="text" name="ic_number[]" class="form-control" />'
            cols += '</div>'
            cols += '</div>'
            cols += '</div>'
            cols += '<div class="row">'
            cols += '<div class="col">'
            cols += '<div class="form-group">'
            cols += '<label for="">Mobile No.</label>'
            cols += '<input type="text" name="mobile_number[]" class="form-control" />'
            cols += '</div>'
            cols += '</div>'
            cols += '<div class="col">'
            cols += '<div class="form-group">'
            cols += '<label for="">Occupation</label>'
            cols += '<input type="text" name="occupation[]" class="form-control" />'
            cols += '</div>'
            cols += '</div>'
            cols += '<div class="col">'
            cols += '<div class="form-group">'
            cols += '<label for="">Income Tax No.</label>'
            cols += '<input type="text" name="income_tax_number[]" class="form-control" />'
            cols += '</div>'
            cols += '</div>'
            cols += '</div>'
            cols += '</div>'
            cols += '</div>';
            newRow.append(cols);
            $(".dynamic-list").append(newRow);
            counter++;
        });

        $(".dynamic-list").on("click", ".ibtnDel", function (event) {
            $(this).closest("div.card").remove();
            counter -= 1
        });
    });

</script>
