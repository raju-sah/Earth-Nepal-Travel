<script>
    $(document).ready(function() {

        $('#{{ $id }}').change(function() {
            var journeyType = $(this).val();
            if (journeyType) {
                $.ajax({
                    url: 'get-journey/' + journeyType,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#{{ $child_id }}').empty();
                        $.each(data, function(key, value) {
                            $('#{{ $child_id }}').append('<option value="' + key + '">' + value + '</option>');
                        });
                    }
                });
            } else {
                $('#{{ $child_id }}').empty();
            }
        });
    });
</script>