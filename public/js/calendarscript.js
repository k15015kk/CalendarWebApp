$(function () {
    $('.calendar-day').on('click', function () {
        var directory = $(this).attr("id");
        window.location.href = "/home/" + directory;
    });
});

function displaySetting(n,startPx,displayPx) {
    $('#' + n).css({
        'display': 'block',
        'position': 'absolute',
        'margin-top': startPx + 'px',
        'height': displayPx + 'px'
    });
}