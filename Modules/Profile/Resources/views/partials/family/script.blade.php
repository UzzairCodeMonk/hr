<script type="text/javascript">
    $(document).ready(function () {
        var counter = 2;

        $("#addrow").on("click", function () {
            var newRow = $("<tr>");
            var cols = "";
            cols += '<td>' + counter + '</td>';
            cols += '<td><input type="text" class="form-control" name="name[]" /></td>';
            cols += '<td>';
            cols += '<select name="relationship_id[]" id="" class="form-control">@foreach($types as $type)';
            cols += '<option value="{{$type->id}}" >{{$type->name}}</option>@endforeach</select></td>';
            cols += '<td><input type="text" class="form-control" name="ic_number[]" /></td>';
            cols += '<td><input type="text" class="form-control" name="mobile_number[]" /></td>';
            cols += '<td><input type="text" class="form-control" name="occupation[]" /></td>';
            cols += '<td><input type="text" class="form-control" name="income_tax_number[]" /></td>';
            cols +=
                '<td><input type="button" class="ibtnDel btn btn-block btn-danger " value="Remove"></td>';
            newRow.append(cols);
            $("table.dynamic-list").append(newRow);
            counter++;
        });

        $("table.dynamic-list").on("click", ".ibtnDel", function (event) {
            $(this).closest("tr").remove();
            counter -= 1
        });
    });

</script>
