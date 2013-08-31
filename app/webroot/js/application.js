$(function() {
    $('button.cancel-btn').on('click', function() {
        window.location.href = app.BASE_PATH+$(this).data('action');
    });
});