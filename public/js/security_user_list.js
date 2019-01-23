improve_filter_form_after_ajax = function () {

    $('.form-group').addClass('col-md-6').addClass('float-left');

};

$(document).on('after-filter-form-executed','#filter_form', function(event){
    improve_filter_form_after_ajax();
});

$(document).ready(function () {
    improve_filter_form_after_ajax();
});
