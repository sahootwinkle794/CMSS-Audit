/*---------------------------------------------
Template name :  Bizidea
Version       :  1.0
Author        :  ThemeLooks
Author url    :  http://themelooks.com

NOTE:
------
Please DO NOT EDIT THIS JS, you may need to use "custom.js" file for writing your custom js.
We may release future updates so it will overwrite this file. it's better and safer to use "custom.js".

[Table of Content]

    01: Main Menu
    02: Sticky Nav
    03: Offcanvas
    04: Background Image
    05: Check Data
    06: Owl Carousel
    07: Counter Up
    08: Video Popup
    09: Changing svg color
    10: Google map
    11: Preloader
    12: Isotope
    13: Contact Form
    14: Back to top button
    15: Countdown
----------------------------------------------*/

//---------------------------------------------------------------- news scroll Start----------------------------------------------------------------------------




//---------------------------------------------------------------- news scroll end------------------------------------------------------------------------



(function ($) {
    "use strict";

    /*===================
    01: Main Menu
    =====================*/
    $('.header-menu a[href="#"]').on('click', function (event) {
        event.preventDefault();
    });

    /* Menu Maker */
    $(".main-menu").menumaker({
        title: '<span></span>',
        format: "multitoggle"
    });

    $($(window)).on('scroll', function () {
        if (!$('ul.nav').hasClass('open')) {
            $('#menu-button').removeClass('menu-opened');
        };
    });

    /*========================
    02: Sticky Nav
    ==========================*/
    $(window).on("scroll", function () {
        var scroll = $(window).scrollTop();
        if (scroll < 100) {
            $(".header-main.style--one").removeClass("sticky fadeInDown animated");
        }
        else {
            $(".header-main.style--one").addClass("sticky fadeInDown animated");
        }
    });

    /*========================
    03: Offcanvas
    ==========================*/
    $('.offcanvas-trigger').on('click', function () {
        $('.offcanvas-wrapper').addClass('active');
        $('.offcanvas-overlay').addClass('show');
    });

    $('.offcanvas-overlay,.offcanvas-close').on('click', function () {
        $('.offcanvas-overlay').removeClass('show');
        $('.offcanvas-wrapper').removeClass('active');
    })

    /*========================
    04: Background Image
    ==========================*/
    var $bgImg = $('[data-bg-img]');
    $bgImg.css('background-image', function () {
        return 'url("' + $(this).data('bg-img') + '")';
    }).removeAttr('data-bg-img').addClass('bg-img');

    /*==================================
    05: Check Data
    ====================================*/
    var checkData = function (data, value) {
        return typeof data === 'undefined' ? value : data;
    };

    /*==================================
06: Owl Carousel
====================================*/

    jQuery(document).ready(function ($) {
        var owl = $('.banner-slider');
        owl.owlCarousel();

        var isPlaying = true;
        $('#slider-toggle').click(function () {
            if (isPlaying) {
                owl.trigger('stop.owl.autoplay');
                $(this).text('Play');
            } else {
                owl.trigger('play.owl.autoplay', [5000]);
                $(this).text('Pause');
            }
            isPlaying = !isPlaying;
        });
    });

// By trupti for play and pause button

    jQuery(document).ready(function ($) {

    var offerOwl = $('.what-we-offer-section');
    offerOwl.owlCarousel();

    var offerPlaying = true;

    $('#offer-slider-toggle').click(function () {

        if (offerPlaying) {
            offerOwl.trigger('stop.owl.autoplay');
            $(this).text('▶ Play');
            $(this).attr('aria-label', 'Play What We Offer Slider');
        } else {
            offerOwl.trigger('play.owl.autoplay', [5000]);
            $(this).text('⏸ Pause');
            $(this).attr('aria-label', 'Pause What We Offer Slider');
        }

        offerPlaying = !offerPlaying;
    });

});

// By trupti for achivements section
jQuery(document).ready(function ($) {

    /* ===============================
       BANNER SLIDER
    =============================== */

    var bannerOwl = $('.banner-slider');

    bannerOwl.owlCarousel({
        items: 1,
        loop: true,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        nav: true,
        dots: false,
        animateIn: 'fadeIn',
        animateOut: 'fadeOut'
    });

    var bannerPlaying = true;

    $('#slider-toggle').on('click', function () {

        if (bannerPlaying) {
            bannerOwl.trigger('stop.owl.autoplay');
            $(this).text('▶ Play')
                   .attr('aria-label', 'Play Banner Slider');
        } else {
            bannerOwl.trigger('play.owl.autoplay', [5000]);
            $(this).text('⏸ Pause')
                   .attr('aria-label', 'Pause Banner Slider');
        }

        bannerPlaying = !bannerPlaying;
    });



    /* ===============================
       ACHIEVEMENTS SLIDER
    =============================== */

    var achievementOwl = $('.achievement');

    achievementOwl.owlCarousel({
        loop: true,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        margin: 30,
        responsive: {
            0: { items: 1 },
            600: { items: 2 },
            800: { items: 3 },
            992: { items: 4 }
        }
    });

    var achievementPlaying = true;

    $('#achievement-slider-toggle').on('click', function () {

        if (achievementPlaying) {
            achievementOwl.trigger('stop.owl.autoplay');
            $(this).text('▶ Play')
                   .attr('aria-label', 'Play Achievements Slider');
        } else {
            achievementOwl.trigger('play.owl.autoplay', [5000]);
            $(this).text('⏸ Pause')
                   .attr('aria-label', 'Pause Achievements Slider');
        }

        achievementPlaying = !achievementPlaying;
    });

});


// Button code for esteemed suppliers by trupti


jQuery(document).ready(function ($) {

    var suppliersSlider = $('.our-esteemed');
    var isPlaying = true;

    $('#suppliers-toggle').on('click', function () {

        if (isPlaying) {
            suppliersSlider.trigger('stop.owl.autoplay');
            $(this)
                .text('▶ Play')
                .attr('aria-label', 'Play Suppliers Slider');
        } else {
            suppliersSlider.trigger('play.owl.autoplay');
            $(this)
                .text('⏸ Pause')
                .attr('aria-label', 'Pause Suppliers Slider');
        }

        isPlaying = !isPlaying;
    });

});


//  Button code for dashboard by trupti

jQuery(document).ready(function ($) {

    var dashboardSlider = $('.section-dashboard');
    var isPlayingDashboard = true;

    $('#dashboard-toggle').on('click', function () {

        if (isPlayingDashboard) {
            dashboardSlider.trigger('stop.owl.autoplay');
            $(this)
                .text('▶ Play')
                .attr('aria-label', 'Play Dashboard Slider');
        } else {
            dashboardSlider.trigger('play.owl.autoplay');
            $(this)
                .text('⏸ Pause')
                .attr('aria-label', 'Pause Dashboard Slider');
        }

        isPlayingDashboard = !isPlayingDashboard;
    });

});







    

    /*==================================
    06: Owl Carousel
    ====================================*/
    var $owlCarousel = $('.owl-carousel');
    $owlCarousel.each(function () {
        var $t = $(this);

        $t.owlCarousel({
            items: checkData($t.data('owl-items'), 1),
            margin: checkData($t.data('owl-margin'), 0),
            loop: checkData($t.data('owl-loop'), true),
            smartSpeed: 650,
            autoplay: checkData($t.data('owl-autoplay'), true),
            autoplayTimeout: checkData($t.data('owl-speed'), 8000),
            center: checkData($t.data('owl-center'), false),
            animateIn: checkData($t.data('owl-animate-in'), false),
            animateOut: checkData($t.data('owl-animate-out'), false),
            nav: checkData($t.data('owl-nav'), true),
            navText: ['<img src="wp-content/themes/suppliers/assets/img/icons/angle-left-red.svg" class="svg" alt="Previous image">',
                '<img src="wp-content/themes/suppliers/assets/img/icons/angle-right-red.svg" class="svg" alt="Next image">'],
            dots: checkData($t.data('owl-dots'), false),
            responsive: checkData($t.data('owl-responsive'), {})
        });

        // Ensure nav buttons have proper ARIA labels
        $t.find('.owl-prev').attr('aria-label', 'Previous');
        $t.find('.owl-next').attr('aria-label', 'Next');
    });

    var $owlCarousel = $('.blogowl-carousel');
    $owlCarousel.each(function () {
        var $t = $(this);

        $t.owlCarousel({
            items: checkData($t.data('owl-items'), 1),
            margin: checkData($t.data('owl-margin'), 0),
            loop: checkData($t.data('owl-loop'), true),
            smartSpeed: 450,
            autoplay: checkData($t.data('owl-autoplay'), true),
            autoplayTimeout: checkData($t.data('owl-speed'), 8000),
            center: checkData($t.data('owl-center'), false),
            animateIn: checkData($t.data('owl-animate-in'), false),
            animateOut: checkData($t.data('owl-animate-out'), false),
            nav: checkData($t.data('owl-nav'), true),
            navText: ['<img src="wp-content/themes/suppliers/assets/img/icons/angle-left-red.svg" class="svg" alt="Previous image">',
                '<img src="wp-content/themes/suppliers/assets/img/icons/angle-right-red.svg" class="svg" alt="Next image">'],
            dots: checkData($t.data('owl-dots'), false),
            responsive: checkData($t.data('owl-responsive'), {})
        });
        // Ensure nav buttons have proper ARIA labels
        $t.find('.owl-prev').attr('aria-label', 'Previous');
        $t.find('.owl-next').attr('aria-label', 'Next');
    });
    /*==================================
    07: Counter Up
    ====================================*/
    $(".count span").counterUp({
        delay: 30,
        time: 2000
    });

    /*========================
    08: Video Popup
    ==========================*/
    var $popUpVideo = $('.popup-video');
    if ($popUpVideo.length) {
        $popUpVideo.magnificPopup({
            type: 'iframe'
        });
    };
    $('.photopopup').magnificPopup({
        type: 'image',
        gallery: {
            enabled: true
        }
    });
    /*==================================
    09: Changing svg color 
    ====================================*/
    jQuery('img.svg').each(function () {
        var $img = jQuery(this);
        var imgID = $img.attr('id');
        var imgClass = $img.attr('class');
        var imgURL = $img.attr('src');

        jQuery.get(imgURL, function (data) {
            // Get the SVG tag, ignore the rest
            var $svg = jQuery(data).find('svg');

            // Add replaced image's ID to the new SVG
            if (typeof imgID !== 'undefined') {
                $svg = $svg.attr('id', imgID);
            }
            // Add replaced image's classes to the new SVG
            if (typeof imgClass !== 'undefined') {
                $svg = $svg.attr('class', imgClass + ' replaced-svg');
            }

            // Remove any invalid XML tags as per http://validator.w3.org
            $svg = $svg.removeAttr('xmlns:a');

            // Check if the viewport is set, else we gonna set it if we can.
            if (!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
                $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'));
            }

            // Replace image with new SVG
            $img.replaceWith($svg);

        }, 'xml');
    });


    /*==================================
    11: Preloader 
    ====================================*/
    $(window).on('load', function () {
        $('.preloader').fadeOut(1000);
    });

    /*==================================
    12: Isotope
    ====================================*/
    $(window).on('load', function () {
        $('.project-items').isotope({
            itemSelector: '.grid-item',
            percentPosition: true,
            animationOptions: {
                duration: 750,
                easing: "linear",
                queue: false
            },
            masonry: {
                columnWidth: '.grid-item'
            }
        });

        $('.project_filter li').on('click', function () {
            $(this).addClass('active').siblings().removeClass('active');
            var filterValue = $(this).attr('data-filter');
            $('.grid').isotope({
                filter: filterValue
            });
        });
    });

    /*==================================
    13: Contact Form
    ====================================*/
    $('.contact-form-wrapper').on('submit', 'form', function (e) {
        e.preventDefault();

        var $el = $(this);

        $.post($el.attr('action'), $el.serialize(), function (res) {
            res = $.parseJSON(res);
            $el.parent('.contact-form-wrapper').find('.form-response').html('<span>' + res[1] + '</span>');
        });
    });
    /* - Counter App */
    if ($(".counter-app").length) {
        $('.counter-app').each(function () {
            var $this = $(this);
            var myVal = $(this).data("value");
            $this.appear(function () {
                var statistics_item_count = 0;
                var statistics_count = 0;
                statistics_item_count = $("[id*='statistics_count-']").length;
                for (var i = 1; i <= statistics_item_count; i++) {
                    statistics_count = $("[id*='statistics_count-" + i + "']").attr("data-statistics_percent");
                    $("[id*='statistics_count-" + i + "']").animateNumber({ number: statistics_count }, 2000);
                }
            });
        });
    }
    /*============================================
    14: Back to top button
    ==============================================*/
    var $backToTopBtn = $('.back-to-top');

    if ($backToTopBtn.length) {
        var scrollTrigger = 400, // px
            backToTop = function () {
                var scrollTop = $(window).scrollTop();
                if (scrollTop > scrollTrigger) {
                    $backToTopBtn.addClass('show');
                } else {
                    $backToTopBtn.removeClass('show');
                }
            };

        backToTop();

        $(window).on('scroll', function () {
            backToTop();
        });

        $backToTopBtn.on('click', function (e) {
            e.preventDefault();
            $('html,body').animate({
                scrollTop: 0
            }, 700);
        });
    }



}(jQuery));



