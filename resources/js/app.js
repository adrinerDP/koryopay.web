require('./bootstrap');

$(() => {
    $('.swal2-cancel').on('click', (e) => {
        e.preventDefault();
        location.href = '/unlock';
    });
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
    });
    $('[data-toggle="tooltip"]').tooltip();
})
