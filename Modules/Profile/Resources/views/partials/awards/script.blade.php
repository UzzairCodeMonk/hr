<script type="text/javascript">
    $(document).ready(function () {
        var counter = 2;

        $("#addrow").on("click", function () {
            $(".received-date").datepicker("destroy");
            var newRow = $("<tr>");
            var cols = "";

            cols += '<td>' + counter + '</td>';
            cols += '<td><input type="text" class="form-control" name="name[]" /></td>';
            cols +=
                '<td><input type="text" class="form-control received-date" name="received_date[]" /></td>';
            cols += '<td><input type="text" class="form-control" name="notes[]" /></td>';
            cols +=
                '<td><input type="button" class="ibtnDel btn btn-block btn-danger " value="Remove"></td>';
            newRow.append(cols);
            $("table.dynamic-list").append(newRow);
            counter++;
            $(".received-date").datepicker();
        });

        $("table.dynamic-list").on("click", ".ibtnDel", function (event) {
            $(this).closest("tr").remove();
            counter -= 1
        });

        $('#records').on('click', function (e) {
            if ($(this).is(':checked', true)) {
                $(".record-checkbox").prop('checked', true);
            } else {
                $(".record-checkbox").prop('checked', false);
            }
        });
    });

</script>
