<script type="text/javascript">

function confirmFormSubmit<?php echo $entity ?>(){
    return confirm('Are you sure you want to <?php echo $action; ?> this record?');
}
</script>