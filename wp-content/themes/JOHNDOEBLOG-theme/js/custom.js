(function ($) {
    'use strict';
    
    $(window).load(function () {
	    $(".responsive").fitText(1.2);
        $('.hider-page').fadeOut(800);
    });

    $(document).ready(function () {
        $(".flexnav").flexNav();
        $('#gallery').least({
            'lazyload': false
        });

/*-----------------------------------------------------------------------------------*/
/*	Top Panel
/*-----------------------------------------------------------------------------------*/

        $('.top-panel-button').on("click", function () {
            $('.top-panel-content').slideToggle();
            $(this).toggleClass("active");
        });


        $('a[data-rel]').each(function () {
            $(this).attr('rel', $(this).data('rel'));
        });

        //Zoom fix
        // IPad/IPhone
        var viewportmeta = document.querySelector && document.querySelector('meta[name="viewport"]'),
            ua = navigator.userAgent,

            gestureStart = function () {
                viewportmeta.content = "width=device-width, minimum-scale=0.25, maximum-scale=1.6";
            },

            scaleFix = function () {
                if (viewportmeta && /iPhone|iPad/.test(ua) && !/Opera Mini/.test(ua)) {
                    viewportmeta.content = "width=device-width, minimum-scale=1.0, maximum-scale=1.0";
                    document.addEventListener("gesturestart", gestureStart, false);
                }
            };
        scaleFix();


        $('.skills').appear(function () {

            $(".chart").each(function () {
                var $t = $(this);
                var size = $(this).attr('data-size');
                var bgcolor = $(this).attr('data-bgcolor');
                var fgcolor = $(this).attr('data-fgcolor');
                var donutwidth = $(this).attr('data-donutwidth');
                $t.easyPieChart({
                    animate: 2000,
                    barColor: fgcolor,
                    trackColor: bgcolor,
                    lineWidth: donutwidth,
                    lineCap: 'square',
                    size: size,
                    scaleColor: false,
                    onStep: function (value) {
                        this.$el.find('span').text(~~value);
                    }
                });
            });
        });


        $('.bars').appear(function () {
            $('.progress').each(function () {
                var percentage = $(this).find('.bar').attr('data-progress');
                $(this).find('.bar').css('width', '0%');
                $(this).find('.bar').animate({
                    width: percentage + '%'
                }, {
                    duration: 800,
                    easing: 'swing'
                });
            });
        });

        // ---------------------------------------------------------
        // Prettyphoto
        // ---------------------------------------------------------
        var viewportWidth = $('body').innerWidth();
        $("a[rel^='prettyPhoto']").prettyPhoto({
            overlay_gallery: true,
            theme: 'pp_default',
            social_tools: false,
            changepicturecallback: function () {
                // 767px is presumed here to be the widest mobile device. Adjust at will.
                if (viewportWidth < 767) {
                    $(".pp_pic_holder.pp_default").css("top", window.pageYOffset + "px");
                }
            }
        });
        // ---------------------------------------------------------
        // Tooltip
        // ---------------------------------------------------------
        $("[rel='tooltip']").tooltip();
        // ---------------------------------------------------------
        // Back to Top
        // ---------------------------------------------------------
        $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                $('#back-top').fadeIn();
            } else {
                $('#back-top').fadeOut();
            }
        });
        $('#back-top a').click(function () {
            $('body,html').stop(false, false).animate({
                scrollTop: 0
            }, 800);
            return false;
        });
        // ---------------------------------------------------------
        // Add accordion active class
        // ---------------------------------------------------------
        $('.accordion').on('show', function (e) {
            $(e.target).prev('.accordion-heading').find('.accordion-toggle').addClass('active');

        });
        $('.accordion').on('hide', function (e) {
            $(this).find('.accordion-toggle').not($(e.target)).removeClass('active');
        });
        // ---------------------------------------------------------
        // Isotope Init
        // ---------------------------------------------------------
        $("#portfolio-grid").css({
            "visibility": "visible"
        });
        // ---------------------------------------------------------

    });
    $(function () {
        $.stellar({
            horizontalScrolling: false
        });
    });
}(jQuery));