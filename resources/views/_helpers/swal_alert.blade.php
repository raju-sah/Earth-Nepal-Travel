<script>
    function swalAlert(type, title) {
        Swal.fire({
            toast: true,
            position: 'top-end',
            timer: 2000,
            timerProgressBar: true,
            icon: type,
            title: title,
            showConfirmButton: false,
        });
    }
</script>
