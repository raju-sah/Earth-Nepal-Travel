<script>
    (function () {
        $(document).on('click', '.js-add--field-row', function (e) {
            let clone, variationList;
            e.preventDefault();

            variationList = $('#form-variations-list');
            clone = $('#template-form').contents().clone();

            clone.append($("<button style='position: relative; top: 34px; width: 40px; height:37px;'>").addClass('btn btn-danger btn-sm js-remove--field-row').append("<i class='bx bx-trash bx-xs'></i>"));

            let index = variationList.children('.form-group').length + 1;

            clone.find('input').val('').attr('id', function () {
                return $(this).attr('id') + '-' + index
            });

            clone.find('input').val('').attr('name', function () {
                return $(this).attr('name') + index
            });

            variationList.append(clone);
        });

        $(document).on('click', '.js-remove--field-row', function (e) {
            e.preventDefault();
            if(confirm('Do you want to remove this item ?')){
                return $(this).parent().remove();
            }
        });
    }).call(this);
</script>
