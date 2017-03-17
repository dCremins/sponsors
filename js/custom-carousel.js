jQuery(function ($) {
    $('#SponsorLevelIndicators').on('slide.bs.carousel', function () {
        $('.carousel-indicators li').each(function () {
            if ($(this).hasClass('active')) {
              $($(this).next('li')).addClass('brand');
              $($(this).next('li')).removeClass('accent');
              $($(this)).addClass('accent');
              $($(this)).removeClass('brand');
            }

            //$('li').addClass('test');
        });
    });
});
