$(function () {
    $('.calendar-day').on('click', function () {
        var directory = $(this).attr("id");
        window.location.href = "/home/day/" + directory;
    });

    $('.scheduleSTD').on('click', function () {
        $(".chooseChengeDelete").remove();
        var id = $(this).attr("id");
        $(this).css('box-shadow', '0px 2px 3px 2px rgba(0, 0, 0, 0.4)');
        $('.scheduleList').after('<div class="chooseChengeDelete"><div class= "changeArea" ><p>変更</p></div><div class="deleteArea"><p>削除</p></div></div>');
    });

    $(document).click(function (event) {
        var target = $(event.target);
        target.not(".scheduleSTD")

        if (!$(event.target).closest('.scheduleSTD').length) {
            $(".chooseChengeDelete").remove();
            $(".scheduleSTD").css('box-shadow', '0px 0px 0px 0px rgba(0, 0, 0, 0.0)');
        }

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