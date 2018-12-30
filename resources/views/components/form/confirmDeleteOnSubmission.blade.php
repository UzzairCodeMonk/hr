@include('asset-partials.sweetalert')
<script type="text/javascript">
    $(".{!!$entity!!}").on("submit", function () {
        event.preventDefault();
        return swal({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonClass: 'btn btn-outline btn-success',
            cancelButtonClass: 'btn btn-outline btn-danger',
            buttonsStyling: false,
            confirmButtonText: '<i class="ti ti-thumbs-up"></i> Yes, I\'m sure',
            confirmButtonAriaLabel: 'Thumbs up, great!',
            cancelButtonText: '<i class="ti ti-thumbs-down"></i>',
            cancelButtonAriaLabel: 'Thumbs down',
        }).then((result) => {
            if (result.value) {
                $(".{!!$entity!!}").submit();
            }
        });
    });

</script>
