<script>
    const form = $("{{$formId}}");

    function saveData() {
        const formData = new FormData(form[0]);

        $.ajax({
            type: 'POST',
            url: storeRoute,
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            processData: false, // prevent jQuery from automatically processing the form data.
            contentType: false, // automatically set the correct Content-Type header based on the form data.
            success: function(response) {
                resetForm();
                $(document).trigger('fetchEvent', [response]);
                swalMessage('success', response.message);
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    displayErrors(errors);
                } else {
                    swalMessage('error', xhr.responseText);
                }
            }
        });
    }

    function updateData(modelId) {
        let updateUrl = updateRoute.replace(':id', modelId);

        const formData = new FormData(form[0]);

        $.ajax({
            type: 'POST',
            url: updateUrl,
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            processData: false,
            contentType: false,
            success: function(response) {
                $(document).trigger('updateEvent', [response]);
                $(document).trigger('disableEditing');
                resetForm();
                swalMessage('success', response.message);
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    displayErrors(errors);
                } else {
                    swalMessage('error', xhr.responseText);
                }
            }
        });
    }

    function updateDataWithoutImage(modelId) {
        let updateUrl = updateRoute.replace(':id', modelId);

        $.ajax({
            type: 'PUT',
            url: updateUrl,
            data: form.serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $(document).trigger('updateEvent', [response]);
                $(document).trigger('disableEditing');
                resetForm();
                swalMessage('success', response.message);
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    displayErrors(errors);
                } else {
                    swalMessage('error', xhr.responseText);
                }
            }
        });
    }

    function deleteData(modelId) {
        let deleteUrl = deleteRoute.replace(':id', modelId);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: deleteUrl,
            type: 'DELETE',
            success: function(response) {
                $(document).trigger('deleteEvent', [response]);
                swalMessage('error', response.message);
            },
            error: function(xhr) {
                swalMessage('error', xhr.responseText);
            }
        });
    }

    //----------------------------------------------------
    // HELPER FUNCTIONS
    //----------------------------------------------------

    function swalMessage(type, message) {
        Swal.fire({
            toast: true,
            position: 'top-end',
            timer: 1500,
            timerProgressBar: true,
            icon: type,
            title: message,
            showConfirmButton: false,
        });
    }

    function displayErrors(errors) {
        $('.error-message').remove();

        $.each(errors, function(field, messages) {
            const input = $('[name="' + field + '"]');

            const errorContainer = $('<span class="text-danger small error-message"></span>');

            $.each(messages, function(index, message) {
                errorContainer.append('<p>' + message + '</p>');
            });

            input.after(errorContainer);
        });
    }

    function resetForm() {
        $('.error-message').remove();
        form[0].reset();
        form.find('img').attr('src', '').hide();
    }
</script>