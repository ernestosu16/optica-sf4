
function getParameterFromURL(url, name) {
    if (name = (new RegExp('[?&]' + encodeURIComponent(name)
        + '=([^&]*)')).exec(url))
        return decodeURIComponent(name[1]);
    return null;
}

$(document).ready(function () {

    $('#div-ajax-loader').show().hide();

    //$('#body_buttons').prepend($('#btn_filter_form_modal'));

    $(document).on('click', 'a.order-link', function (event) {

        event.preventDefault();
        event.stopPropagation();

        $('#form_filter_order_by').val($(this).data('order-by'));
        $('#form_filter_order_type').val($(this).data('order-type'));

        $('#filter_form').submit();
    });

    $(document).on('click', 'a.page-link', function (event) {

        event.preventDefault();
        event.stopPropagation();

        var href = $(this).prop('href');

        //var page =(href.split('&')[0]+'=1').split('=')[1];

        var page = getParameterFromURL(href, 'page');

        $('#form_filter_page').val(page ? page : 1);

        $('#filter_form').submit();
    });

    $(document).on('click', '#form_filter_submit', function (event) {

        event.preventDefault();
        event.stopPropagation();

        $('#form_filter_page').val(1);

        $('#filter_form').submit();
    });


    $(document).on('click', '#form_filter_reset', function (event) {

        event.preventDefault();
        event.stopPropagation();

        $('#filter_form').find('input,select,textarea').prop('disabled', true);

        //$('#form_filter_page').val(1);

        $('#filter_form').submit();
    });

    $(document).on('submit', '#filter_form', function (event) {

        event.preventDefault();
        event.stopPropagation();

        var url = $('#filter_form').prop('action');
        var data = $('#filter_form').serialize();

        $('#div-ajax-loader').show();

        $('#filter_form').trigger('before-filter-form-executed');

        $.ajax({
            method: "GET",
            url: url,
            data: data,
            dataType: 'html', // 'json'
            async: true,
            success: function (data, textStatus, xhr) {
                //console.log(data);
                $('#body_content').html(data);
                $('#filter_form').trigger('after-filter-form-executed');
                //improve_filter_form_after_ajax();
                $('#div-ajax-loader').hide();
            },
            error: function (xhr, textStatus, errorThrown) {
                console.log(errorThrown);
                alert(errorThrown);
                $('#div-ajax-loader').hide();
            }

        });

    });


});
