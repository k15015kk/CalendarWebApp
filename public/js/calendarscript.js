$(function () {
    $('.calendar-day').on('click', function () {
        var directory = $(this).attr("id");
        window.location.href = "/home/day/" + directory.substr(0, 4) + '/' + directory.substr(4,2) + '/' + directory.substr(6,2);
    });

    $('.weekDate').on('click', function () {
        var directory = $(this).attr("id");
        window.location.href = "/home/day/" + directory.substr(0, 4) + '/' + directory.substr(4, 2) + '/' + directory.substr(6, 2);
    });

    $('.threeDaysDate').on('click', function () {
        var directory = $(this).attr("id");
        window.location.href = "/home/day/" + directory.substr(0, 4) + '/' + directory.substr(4, 2) + '/' + directory.substr(6, 2);
    });

    $('.scheduleSTD').on('click', function () {
        $(".chooseChengeDelete").remove();
        var id = $(this).attr("id");
        $(".scheduleSTD").css('box-shadow', '0px 2px 2px 1px rgba(0, 0, 0, 0.2)');
        $('.scheduleSTD').css('background', '#009688');
        $(this).css('box-shadow', '0px 2px 3px 2px rgba(0, 0, 0, 0.4)');
        $(this).css('background', '#E040FB');
        $('.scheduleList').after('<div class="chooseChengeDelete" id="' + id + '"><div class= "changeArea" ><p>Change</p></div><div class="deleteArea"><p>Delete</p></div></div>');
    });

    $('.weekPlanStick').on('click', function () {
        $(".chooseChengeDelete").remove();
        var id = $(this).attr("id");
        $(this).css('box-shadow', '0px 2px 3px 2px rgba(0, 0, 0, 0.4)');
        $(".weekPlanStick").css('box-shadow', '0px 2px 2px 1px rgba(0, 0, 0, 0.2)');
        $('.weekPlanStick').css('background', '#009688');
        $(this).css('background', '#E040FB');
        $('.weekDisplay').after('<div class="chooseChengeDelete" id="' + id + '"><div class= "changeArea" ><p>Change</p></div><div class="deleteArea"><p>Delete</p></div></div>');
    });

    $('.threeDaysPlanStick').on('click', function () {
        $(".chooseChengeDelete").remove();
        var id = $(this).attr("id");
        $(".threeDaysPlanStick").css('box-shadow', '0px 2px 2px 1px rgba(0, 0, 0, 0.2)');
        $('.threeDaysPlanStick').css('background', '#009688');
        $(this).css('box-shadow', '0px 2px 3px 2px rgba(0, 0, 0, 0.4)');
        $(this).css('background', '#E040FB');
        $('.threeDaysDisplay').after('<div class="chooseChengeDelete" id="' + id + '"><div class= "changeArea" ><p>Change</p></div><div class="deleteArea"><p>Delete</p></div></div>');
    });

    $(document).click(function (event) {
        var target = $(event.target);
        target.not(".scheduleSTD")

        scheduleAreaTarget = $(event.target).closest('.scheduleSTD').length;
        planStickTarget = $(event.target).closest('.weekPlanStick').length;
        threeDaysStickTarget = $(event.target).closest('.threeDaysPlanStick').length;
        changeAreaTarget = $(event.target).closest('.changeArea').length;
        deleteAreaTarget = $(event.target).closest('.deleteArea').length;

        if (!scheduleAreaTarget && !changeAreaTarget && !deleteAreaTarget && !planStickTarget && !threeDaysStickTarget) {
            $(".chooseChengeDelete").remove();
            $(".scheduleSTD").css('box-shadow', '0px 2px 2px 1px rgba(0, 0, 0, 0.2)');
            $('.scheduleSTD').css('background', '#009688');
            $(".weekPlanStick").css('box-shadow', '0px 2px 2px 1px rgba(0, 0, 0, 0.2)');
            $('.weekPlanStick').css('background', '#009688');
            $(".threeDaysPlanStick").css('box-shadow', '0px 2px 2px 1px rgba(0, 0, 0, 0.2)');
            $('.threeDaysPlanStick').css('background', '#009688');
            
        } else if (changeAreaTarget) {
            var directory = $('.chooseChengeDelete').attr("id");
            window.location.href = "/home/change/" + directory; 
        } else if (deleteAreaTarget) {
            var directory = $('.chooseChengeDelete').attr("id");
            window.location.href = "/home/delete/" + directory;  
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