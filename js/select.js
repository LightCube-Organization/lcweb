$('select').change(function () {
    var val = $('select option:selected').val();
    if (val == 'select') return;
    $('section').fadeOut();
    $('section#' + val).fadeIn();
});