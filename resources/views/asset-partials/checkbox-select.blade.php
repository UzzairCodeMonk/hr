<script type="text/javascript">
    
    $("input[name='{{$inputNameOfCheckbox}}[]']").on("change", function () {
        fnUpdateCount();
    });

    $("{{$allCheckboxSelector}}").on('click', function (e) {
        if ($(this).is(':checked', true)) {
            $("{{$checkboxSelector}}").prop('checked', true);
            fnUpdateCount();
        } else {
            $("{{$checkboxSelector}}").prop('checked', false);
            fnUpdateCount();
        }

    });

    var fnUpdateCount = function () {
        var selectedCheckboxCounter = $("input[name='{{$inputNameOfCheckbox}}[]']:checked").length;

        if (selectedCheckboxCounter > 0) {
            $("{{$selectedCheckboxCounterText}}").text('(' + selectedCheckboxCounter + ')');
        } else {
            $("{{$selectedCheckboxCounterText}}").text(' ');
        }
    };

</script>
