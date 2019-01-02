<script type="text/javascript">
    $(document).ready(function () {
        var counter = 2;

        $("#addrow").on("click", function () {
            $(".start-date").datepicker("destroy");
            $(".end-date").datepicker("destroy");
            $('.summernote').summernote('destroy');
            var newRow = $("<tr>");
            var cols = "";
            cols += '<td>' + counter + '</td>';
            cols += '<td><input type="text" class="form-control" name="company[]" /></td>';
            cols += '<td><input type="text" class="form-control" name="position[]" /></td>';
            cols +=
                '<td><input type="text" class="form-control start-date" name="start_date[]" /></td>';
            cols += '<td><input type="text" class="form-control end-date" name="end_date[]" /></td>';
            cols +=
                '<td><textarea name="description[]" class="form-control summernote" id="" cols="30" rows="10"></textarea></td>';
            cols +=
                '<td><input type="button" class="ibtnDel btn btn-block btn-danger " value="Remove"></td>';
            newRow.append(cols);
            $("table.dynamic-list").append(newRow);
            counter++;
            $('.start-date').datepicker({
                format: "{{config('app.date_format_js')}}",
            });
            $('.end-date').datepicker({
                format: "{{config('app.date_format_js')}}",
            });
            $('.summernote').summernote({
                toolbar: [
                    // [groupName, [list of button]]                    
                    ['para', ['ul', 'ol']]
                ],
                width:300
            });
        });

        $("table.dynamic-list").on("click", ".ibtnDel", function (event) {
            $(this).closest("tr").remove();
            counter -= 1
        });
    });

</script>
