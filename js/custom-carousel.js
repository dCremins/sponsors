jQuery(function ($) {

    var totalItems = $('#SponsorLevelIndicators li.background').length;
    var nextIndex = $('#SponsorLevelIndicators li.active').index() + 2;
    if (nextIndex == 6) {
      nextIndex = 1;
    }
    var prevIndex = $('#SponsorLevelIndicators li.active').index();
    if (prevIndex == 0) {
      prevIndex = 5;
    }

      $('a.carousel-control-next').attr('aria-label', 'show slide '+nextIndex+' of '+totalItems+'');
      $('a.carousel-control-prev').attr('aria-label', 'show slide '+prevIndex+' of '+totalItems+'');


    $('#SponsorLevelIndicators').on('slid.bs.carousel', function () {
        $('li.brand').addClass('accent');
        $('li.brand').removeClass('brand');
        $('li.active').removeClass('accent');
        $('li.active').addClass('brand');


        //$('a.carousel-control-next').removeClass(''+currentIndex+'');
        nextIndex = $('#SponsorLevelIndicators li.active').index() + 2;
        if (nextIndex == 6) {
          nextIndex = 1;
        }
        prevIndex = $('#SponsorLevelIndicators li.active').index();
        if (prevIndex == 0) {
          prevIndex = 5;
        }
        $('a.carousel-control-next').attr('aria-label', 'show slide '+nextIndex+' of '+totalItems+'');
        $('a.carousel-control-prev').attr('aria-label', 'show slide '+prevIndex+' of '+totalItems+'');
    });
});
