<h4>Create Leave Type</h4>
<form action="" method="">
    <table id="myTable" class="table table-bordered dynamic-list">
        <thead>
            <tr>
                <th>{{ucwords(__('leave::leave.leave-name'))}}</th>
                <th>{{ucwords(__('leave::leave.max-leave-per-year'))}}</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <input type="text" name="name" class="form-control" />
                </td>
                <td>
                    <input type="text" name="max_per_year" class="form-control" />
                </td>
                <td>
                    <a class="deleteRow">
                        <input type="button" class="btn btn-block" id="addrow" value="Add Row" />
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="form-group">
        <button type="submit" class="btn btn-primary pull-right">
            Submit
        </button>
    </div>
</form>
@section('page-js')
<script type="text/javascript">
    $(document).ready(function () {
        var counter = 0;

        $("#addrow").on("click", function () {
            var newRow = $("<tr>");
            var cols = "";

            cols += '<td><input type="text" class="form-control" name="result' + counter + '" /></td>';
            cols += '<td><input type="text" class="form-control" name="course' + counter + '" /></td>';
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

@endsection
