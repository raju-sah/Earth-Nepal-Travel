<script>
    $(document).ready(function () {
        $('.delete-repeating-item').on('click', function () {
            let dataId = $(this).data('item-id');
            const url = "{{route('admin.delete-repeating-item')}}";

            $.ajax({
                url: url,
                type: 'DELETE',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: dataId,
                    model: "{{$model}}"
                },
                success: function (response) {
                    $(document).trigger('refreshPage');
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }
            });
        })
    });
</script>
