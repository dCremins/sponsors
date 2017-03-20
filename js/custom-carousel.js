jQuery(function ($) {
    $('#SponsorLevelIndicators').on('slid.bs.carousel', function () {
        $('li.brand').addClass('accent');
        $('li.brand').removeClass('brand');
        $('li.active').removeClass('accent');
        $('li.active').addClass('brand')
    });
});
