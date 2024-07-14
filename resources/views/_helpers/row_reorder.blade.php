<!-- Jquery UI js -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

<script type="text/javascript">
    $(function () {
        $("#tablecontents").sortable({
            items: "tr",
            cursor: 'move',
            opacity: 0.6,
            update: function () {
                sendOrderToServer();
            }
        });

        function sendOrderToServer() {

            let order = [];
            $('tr.row1').each(function (index, element) {
                order.push({
                    id: $(this).attr('data-id'),
                    position: index + 1
                });
            });

            $.ajax({
                type: "POST",
                dataType: "json",
                url: rowReorderRoute,
                data: {
                    order: order,
                    _token: '{{csrf_token()}}'
                },
                success: function (response) {
                    console.log(response)
                }, error: function (response) {
                    console.log(response);
                }
            });
        }
    });

</script>
