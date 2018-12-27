<script type="text/javascript">
    $(document).ready(function () {
        var counter = 2;

        $("#addrow").on("click", function () {
            $(".start-date").datepicker("destroy");
            $(".end-date").datepicker("destroy");
            var newRow = $("<tr>");
            var cols = "";

            cols += '<td>' + counter + '</td>';
            cols += '<td><input type="text" class="form-control" name="institution[]" /></td>';
            cols += '<td><input type="text" class="form-control" name="study_level[]" /></td>';
            cols +=
                '<td><input type="text" class="form-control start-date" name="start_date[]" /></td>';
            cols += '<td><input type="text" class="form-control end-date" name="end_date[]" /></td>';
            cols += '<td><input type="text" class="form-control" name="result[]" /></td>';
            cols += '<td><input type="text" class="form-control" name="course[]" /></td>';
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
        });

        $("table.dynamic-list").on("click", ".ibtnDel", function (event) {
            $(this).closest("tr").remove();
            counter -= 1
        });
    });

</script>
