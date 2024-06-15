<script>

    $(document).on('click', '.deleteGalleryImage', function (e) {
        e.preventDefault();

        const dataId = $(this).data('id');
        const imageName = $(this).data('image');

        {{--let url = "{{$route}}".replace(':id', dataId);--}}
        const url = "{{route('admin.delete-gallery-image')}}";

        $.ajax({
            url: url,
            type: 'DELETE',
            data: {
                _token: "{{ csrf_token() }}",
                gallery_id: dataId,
                image_name: imageName,
                folder: "{{$folder}}"
            },
            success: function (response) {
                location.reload();
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            }
        });
    });

</script>
