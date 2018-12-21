@include('asset-partials.sweetalert')
<script type="text/javascript">
    $(".{!!$entity!!}").on("submit", function () {
        event.preventDefault();
        return swal({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
        }).then((result) => {
            if (result.value) {
                $(".{!!$entity!!}").submit();
            }
        });
    });

</script>
