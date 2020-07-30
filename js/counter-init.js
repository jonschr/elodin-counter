jQuery(document).ready(function ($) {
    $('.elodin-counter').each(function () {

        var delay = $(this).attr('data-delay');
        var time = $(this).attr('data-time');

        $(this).counterUp({
            delay: delay,
            time: time,
        });
    });
});