(function($) {

    "use strict";
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        startDate: '-Infinity'
    });

    $('.datepicker2').datepicker({
        format: 'yyyy-mm-dd'
    });

    $('.book-appointment .schedule').on('click', function() {
        $('.book-appointment .schedule').css('background-color', '#ddd');
        $('.book-appointment .schedule').css('color', '#333');
        $(this).css('background-color', '#f1634c');
        $(this).css('color', '#fff');
    });

    // caching selectors
    var mainWindow = $(window),
        mainBody = $('body'),
        mainpreStatus = $('#preloader-status'),
        mainPreloader = $('#preloader'),
        strickymenu = $('#strickymenu'),
        dropdown_menu = $('.dropdown-menu'),
        dropdown_toggle = $('.dropdown-toggle'),
        carousel = $('.carousel'),
        slideCarousel = $('.slide-carousel'),
        owl_testimonial = $('.owl-testimonial'),
        team_carousel = $('.team-carousel'),
        blog_carousel = $('.blog-carousel'),
        brand_carousel = $('.brand-carousel'),
        portfolioNav = $('.portfolio-nav'),
        relative_ptCarousel = $('.relative-pt-carousel'),
        relative_product = $('.relative-product-carousel'),
        select2 = $('.select2'),
        mgVideo = $(".mgVideo"),
        magnific = $('.magnific'),
        open_popup_link = $('.open-popup-link'),
        filtr_container = $('.filtr-container'),
        filtrnav_li = $('#filtrnav li'),
        filtr = $('.filtr'),
        scrollUp = $(".scroll-top"),
        counter = $('.counter');


    mainWindow.on('load', function() {

        // Preloader
        mainPreloader.fadeOut();
        mainpreStatus.delay(250).fadeOut('slow');
        mainBody.delay(250).css({
            'overflow-x': 'hidden'
        });

        // StickyHeader
        function stickyHeader() {
            var strickyScrollPos = strickymenu.next().offset().top;
            if (strickymenu.length) {
                if (mainWindow.scrollTop() > strickyScrollPos) {
                    strickymenu.addClass('sticky');
                    mainBody.addClass('sticky');
                } else if (mainWindow.scrollTop() <= strickyScrollPos) {
                    strickymenu.removeClass('sticky');
                    mainBody.removeClass('sticky');
                }
            };
        }
        mainWindow.on('scroll', function() {
            stickyHeader();
        });

        //Search
        dropdown_menu.hide();
        dropdown_toggle.on('click', function() {
            dropdown_menu.fadeToggle();
        });

        //Carousel
        carousel.carousel();

        // Slider
        slideCarousel.owlCarousel({
            rtl: rtlTrue ? true : false,
            loop: true,
            autoplay: true,
            autoplayHoverPause: true,
            autoplaySpeed: 1500,
            smartSpeed: 1500,
            margin: 0,
            animateIn: 'fadeIn',
            animateOut: 'fadeOut',
            dots: true,
            nav: false,
            navText: ["<i class='fa fa-caret-left'></i>", "<i class='fa fa-caret-right'></i>"],
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        });

        slideCarousel.on('translate.owl.carousel', function() {
            $('.text-animated h1').removeClass('fadeInDown animated').hide();
            $('.text-animated p').removeClass('fadeInUp animated').hide();
            $('.text-animated li').removeClass('fadeInUp animated').hide();
        });

        slideCarousel.on('translated.owl.carousel', function() {
            $('.text-animated h1').addClass('fadeInDown animated').show();
            $('.text-animated p').addClass('fadeInUp animated').show();
            $('.text-animated li').addClass('fadeInUp animated').show();
        });

        // Testimonial
        owl_testimonial.owlCarousel({
            rtl: rtlTrue ? true : false,
            loop: true,
            autoplay: true,
            autoplayHoverPause: true,
            margin: 30,
            dots: true,
            nav: false,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            responsive: {
                0: {
                    items: 1
                },
                460: {
                    items: 1
                },
                768: {
                    items: 1
                },
                992: {
                    items: 1
                }
            }
        });


        // Team
        team_carousel.owlCarousel({
            rtl: rtlTrue ? true : false,
            loop: false,
            autoplay: true,
            autoplayHoverPause: true,
            autoplaySpeed: 1500,
            smartSpeed: 1500,
            margin: 30,
            nav: true,
            navText: ["<i class='fa fa-caret-left'></i>", "<i class='fa fa-caret-right'></i>"],
            responsive: {
                0: {
                    items: 1,
                    nav: false
                },
                540: {
                    items: 2,
                    nav: false
                },
                991: {
                    items: 3,
                    nav: false
                },
                1199: {
                    items: 4,
                    nav: false
                }
            }
        });

        // Blog
        blog_carousel.owlCarousel({
            rtl: rtlTrue ? true : false,
            loop: false,
            autoplay: true,
            autoplayHoverPause: true,
            autoplaySpeed: 1500,
            smartSpeed: 1500,
            margin: 30,
            nav: false,
            navText: ["<i class='fa fa-caret-left'></i>", "<i class='fa fa-caret-right'></i>"],
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2
                },
                768: {
                    items: 1
                },
                991: {
                    items: 1
                },
                1200: {
                    items: 2
                }
            }
        });



        // Brand
        brand_carousel.owlCarousel({
            rtl: rtlTrue ? true : false,
            loop: true,
            autoplay: true,
            autoplayHoverPause: true,
            autoplaySpeed: 1500,
            smartSpeed: 1500,
            margin: 30,
            nav: false,
            navText: ["<i class='fa fa-caret-left'></i>", "<i class='fa fa-caret-right'></i>"],
            responsive: {
                0: {
                    items: 2
                },
                750: {
                    items: 3
                },
                991: {
                    items: 3
                },
                1200: {
                    items: 4
                }
            }
        });

        // Portfolio Nav
        portfolioNav.owlCarousel({
            rtl: rtlTrue ? true : false,
            loop: false,
            autoplay: true,
            autoplayHoverPause: true,
            margin: 15,
            nav: true,
            navText: ["<i class='fa fa-caret-left'></i>", "<i class='fa fa-caret-right'></i>"],
            responsive: {
                0: {
                    items: 3
                },
                520: {
                    items: 5
                },
                750: {
                    items: 6
                },
                1000: {
                    items: 7
                }
            }
        });


        // Relative Protfolio
        relative_ptCarousel.owlCarousel({
            rtl: rtlTrue ? true : false,
            loop: true,
            autoplay: true,
            autoplayHoverPause: true,
            autoplaySpeed: 1500,
            smartSpeed: 1500,
            margin: 30,
            nav: true,
            navText: ["<i class='fa fa-caret-left'></i>", "<i class='fa fa-caret-right'></i>"],
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 1,
                    dots: false
                },
                768: {
                    items: 2,
                    nav: false
                },
                991: {
                    items: 3,
                    nav: false
                },
                1200: {
                    items: 3,
                    nav: false
                }
            }
        });


        // Relative Product
        relative_product.owlCarousel({
            rtl: rtlTrue ? true : false,
            loop: true,
            autoplay: true,
            autoplayHoverPause: true,
            autoplaySpeed: 1500,
            smartSpeed: 1500,
            margin: 30,
            nav: true,
            navText: ["<i class='fa fa-caret-left'></i>", "<i class='fa fa-caret-right'></i>"],
            responsive: {
                0: {
                    items: 1
                },
                576: {
                    items: 2,
                    dots: false
                },
                768: {
                    items: 2,
                    nav: false
                },
                991: {
                    items: 3,
                    nav: false
                },
                1200: {
                    items: 4,
                    nav: false
                }
            }
        });

        select2.select2();

        // Magnific Popup Video
        mgVideo.magnificPopup({
            type: 'iframe',
            iframe: {
                markup: '<div class="mfp-iframe-scaler">' +
                    '<div class="mfp-close"></div>' +
                    '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>' +
                    '</div>',
                patterns: {
                    youtube: {
                        index: 'youtube.com/',
                        id: 'v=',
                        src: 'https://www.youtube.com/embed/%id%?autoplay=1'
                    },
                    vimeo: {
                        index: 'vimeo.com/',
                        id: '/',
                        src: 'https://player.vimeo.com/video/%id%?autoplay=1'
                    },
                    gmaps: {
                        index: '//maps.google.',
                        src: '%id%&output=embed'
                    }
                },
                srcAction: 'iframe_src',
            }
        });

        //Team Swiper
        var swiper = new Swiper('.team-swiper', {
            effect: 'coverflow',
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: 'auto',
            loop: true,
            spaceBetween: 15,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            coverflowEffect: {
                rotate: 50,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows: true,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });

        //Brand Swiper
        var swiper = new Swiper('.brand-swiper', {
            slidesPerView: 4,
            slidesPerColumn: 2,
            spaceBetween: 30,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });

        //Single Product
        var galleryThumbs = new Swiper('.pro-detail-thumbs', {
            spaceBetween: 10,
            slidesPerView: 4,
            loop: false,
            freeMode: true,
            loopedSlides: 5, //looped slides should be the same
            watchSlidesVisibility: true,
            watchSlidesProgress: true,
        });
        var galleryTop = new Swiper('.pro-detail-top', {
            spaceBetween: 10,
            loop: false,
            loopedSlides: 5, //looped slides should be the same
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            thumbs: {
                swiper: galleryThumbs,
            },
        });



        // filter-price
        $("#range-bar").slider({
            range: true,
            min: 5,
            max: 1500,
            values: [240, 960],
            slide: function(event, ui) {
                $("#range-show").html(ui.values[0] + '$' + '-' + ui.values[1] + '$');
            }
        });
        $("#range-show").html($("#range-bar").slider('values', 0) + '$' + '-' + $("#range-bar").slider('values', 1) + '$');

        // Spinner
        $("#shop_spinner").spinner({
            min: 1
        });

        // Magnific Popup
        magnific.magnificPopup({
            type: 'image',
            gallery: {
                enabled: true
            }
        });

        open_popup_link.magnificPopup({
            type: 'inline',
            midClick: true
        });


        // Scroll-Top
        scrollUp.hide();
        mainWindow.on("scroll", function() {
            if ($(this).scrollTop() > 300) {
                scrollUp.fadeIn();
            } else {
                scrollUp.fadeOut();
            }
        });
        scrollUp.on("click", function() {
            $("html, body").animate({
                scrollTop: 0,
            }, 700)
        });

        $('.mySelect2Item').select2({
            dropdownParent: $('#appointment_modal1')
        });

    });

})(jQuery);
