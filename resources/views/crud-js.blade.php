<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2();
        
        var crud_form = $('.crud-form');
        var crud_button = $('.crud-button');
        var crud_button_content = crud_button.html();

        crud_form.submit(function(event) {
            event.preventDefault();

            crud_button.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>&nbsp;Please Wait...');

            $.ajax({
                url: crud_form.attr('action'),
                type: crud_form.attr('method'),
                dataType: 'json',
                processData: false,
                contentType: false,
                data: new FormData(crud_form[0]),
            })
            .done(function(response) {
                if(response.success){
                    reloadDatatable();
                    $('#modal').modal('hide');
                    notify(response.message, 'success');
                }else{
                    notify(response.message, 'danger');
                }
                crud_button.prop('disabled', false).html(crud_button_content);
            })
            .fail(function(response) {
                $.each(response.responseJSON.errors, function(index, val) {
                    notify(val[0], 'danger');
                });
                crud_button.prop('disabled', false).html(crud_button_content);
            });
        });
    });
</script>